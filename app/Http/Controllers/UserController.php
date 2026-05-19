<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Hospital;
use App\Models\BloodRequest;
use App\Models\Donation;
use App\Models\Appointment;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hospitals = Hospital::paginate(20, ['*'], 'hospitalspage');
        $users = User::paginate(20, ['*'], 'userspage');
        $bloodrequests = BloodRequest::with(['user', 'hospital'])->paginate(20, ['*'], 'requesetspage');
        $donations = Donation::with(['user' => function($query){ $query->withTrashed(); }])->paginate(20, ['*'], 'donationspage');
        $donacion = Donation::where('user_id', Auth::id())->paginate(20, ['*'], 'donacionspage');

        
        $inventoryQuery = \App\Models\Inventory::with(['donation.user', 'donation.hospital']);
        if ($user->role === 'hospital_staff') {
            $inventoryQuery->whereHas('donation', function ($q) use ($user) {
                $q->where('hospital_id', $user->hospital_id);
            });
        }
        $inventory = $inventoryQuery->latest()->paginate(20, ['*'], 'inventorypage');

        
        // Appointments — scoped for hospital_staff
        $appointmentQuery = Appointment::with(['user', 'hospital', 'donation', 'bloodRequest']);
        if ($user->role === 'hospital_staff') {
            $appointmentQuery->where('hospital_id', $user->hospital_id);
        }
        $appointments = $appointmentQuery->latest()->paginate(20, ['*'], 'appointmentsspage');

        if ($user->role === 'hospital_staff') {
            $donations = Donation::with(['user' => function($q){ $q->withTrashed(); }])
                ->where('hospital_id', $user->hospital_id)->paginate(20, ['*'], 'donationspage');
            $bloodrequests = BloodRequest::where('hospital_id', $user->hospital_id)->paginate(20, ['*'], 'requesetspage');
        }

        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('users', 'hospitals', 'bloodrequests', 'donations', 'appointments', 'inventory'));
        } elseif ($user->role === 'staff') {
            return view('staff.dashboard', compact('users', 'hospitals', 'bloodrequests', 'donations', 'appointments', 'inventory'));
        } elseif ($user->role === 'hospital_staff') {
            return view('hospital_Staff.dashboard', compact('users', 'hospitals', 'bloodrequests', 'donations', 'appointments', 'inventory'));
        } else {
            return view('users.dashboard', compact('users', 'user', 'hospitals', 'bloodrequests', 'donations', 'donacion', 'appointments', 'inventory'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('auth.registration', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=> 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'middle_name'=> 'nullable|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed',
            'blood_type'=> 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'role'=>'required|in:admin,staff,hospital_staff,user',
            'gender'=> 'required|in:Male,Female',
            'date_of_birth'=>'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'contact_info'=> 'required',
            'hospital_id' => 'required if:role,hospital_staff|nullable||exists:hospital,hospital_id',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'blood_type' => $request->blood_type,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'date_of_birth'=> $request->date_of_birth,
            'contact_info' => $request->contact_info,
            'hospital_id' => $request->hospital_id,
        ]);

        return redirect()->route('login')->with('success', 'User created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $hospitals = Hospital::all();
    // Rename $users to $user
    $user = User::findOrFail($id); 
    $currentuser = Auth::user();

    if ($currentuser->role === 'admin'){
        // Use 'user' in the compact
        return view('users.editusers', compact('user', 'hospitals'));
    } else if ($currentuser->role === 'user'){
        // Use 'user' here too
        return view('users.dashboard', compact('user', 'hospitals', 'currentuser'));
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'middle_name'   => 'nullable|string|max:255',
            'email'         => 'required|email|unique:users,email,'.$id.',user_id',
            'password'      => 'nullable|min:8|confirmed',
            'blood_type'    => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'role'          => 'required|in:admin,staff,hospital_staff,user',
            'gender'        => 'required|in:Male,Female',
            'date_of_birth' => 'required|date|before_or_equal:' . now()->subYears(17)->format('Y-m-d'),
            'contact_info'  => 'required',
            'hospital_id' => 'required if:role,hospital_staff|nullable||exists:hospital,hospital_id',
        ];

        $validated = $request->validate($rules);

        // CRITICAL: If the password field is empty, remove it from the array entirely.
        // If it is NOT empty, keep it as a plain string.
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        // Use the singular $user variable we found at the start
        $user->update($validated);

        return redirect()->route('dashboard')->with('success', 'Profile updated!');
    }

    /**
     * Archive the specified resource (soft delete).
     */
    public function archive(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User archived successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('dashboard')->with('success', 'User deleted permanently');
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            $user = Auth::user();
            if($user->role === 'admin'){
                return redirect()->route('dashboard');
            }
            elseif ($user->role === 'staff') {
                return redirect()->route('dashboard');
            }
            elseif($user->role === 'hospital_staff'){
                return redirect()->route('dashboard');
            }

            return redirect()->intended(route('about'));
        }

        return back()->withErrors([
            'email' => 'email or password invalid.',
        ])->onlyInput('email');
        

        
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function showDashboard(){
        return view('dashboard');
    }

    
}