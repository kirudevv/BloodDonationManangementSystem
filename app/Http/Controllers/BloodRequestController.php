<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Donation;
use App\Models\Appointment;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::paginate(20, ['*'], 'hospitalspage');
        $bloodrequests = BloodRequest::paginate(20, ['*'], 'requesetspage');
        $user = Auth::user();
        $users = User::paginate(20, ['*'], 'userspage');
        $donations = Donation::with(['user' => function($query){$query->withTrashed();}])->paginate(20, ['*'], 'donationspage');
        $donacion = Donation::where('user_id', Auth::id())->paginate(20, ['*'], 'donacionspage');
        $appointments = Appointment::with(['user', 'hospital', 'donation', 'bloodRequest'])->latest()->paginate(20, ['*'], 'appointmentsspage');

        $inventoryQuery = \App\Models\Inventory::with(['donation.user', 'donation.hospital']);
        if ($user->role === 'hospital_staff') {
            $inventoryQuery->whereHas('donation', function ($q) use ($user) {
                $q->where('hospital_id', $user->hospital_id);
            });
            $donations = Donation::with(['user' => function($q){ $q->withTrashed(); }])
                ->where('hospital_id', $user->hospital_id)->paginate(20, ['*'], 'donationspage');
            $bloodrequests = BloodRequest::where('hospital_id', $user->hospital_id)->paginate(20, ['*'], 'requesetspage');
            $appointments = Appointment::with(['user', 'hospital', 'donation', 'bloodRequest'])
                ->where('hospital_id', $user->hospital_id)->latest()->paginate(20, ['*'], 'appointmentsspage');
        }
        $inventory = $inventoryQuery->latest()->paginate(20, ['*'], 'inventorypage');

        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('bloodrequests', 'hospitals', 'users', 'donations', 'appointments', 'inventory'));
        } elseif ($user->role === 'staff') {
            return view('staff.dashboard', compact('bloodrequests', 'hospitals', 'users', 'donations', 'appointments', 'inventory'));
        } elseif ($user->role === 'hospital_staff') {
            return view('hospital_Staff.dashboard', compact('bloodrequests', 'hospitals', 'users', 'donations', 'appointments', 'inventory'));
        } else {
            return view('users.dashboard', compact('bloodrequests', 'hospitals', 'user', 'users', 'donations', 'donacion', 'appointments', 'inventory'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('donation', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'blood_components' => 'required|in:Whole Blood,Platelets,Plasma',
            'units' => 'required|integer|max:10',
            'urgency' => 'required|in:Normal,Urgent,Emergency',
            'attending_physician' => 'required|string|max:1000',
            'address' => 'required|string|max:1000',
            'hospital_id' => 'required|exists:hospital,hospital_id',
            
        ]);

        BloodRequest::create([
            'user_id'             => Auth::id(),
            'blood_type'          => Auth::user()->blood_type,
            'gender'              => Auth::user()->gender,
            'blood_components'    => $request->blood_components,
            'units'               => $request->units,
            'quantity'            => $request->units,
            'urgency'             => $request->urgency,
            'attending_physician' => $request->attending_physician,
            'address'             => $request->address,
            'hospital_id'         => $request->hospital_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Blood request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $bloodrequest = BloodRequest::findOrFail($id);
        $hospitals = Hospital::all();
        return view('users.editrequests', compact('bloodrequest', 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'blood_components' => 'required|in:Whole Blood,Platelets,Plasma',
            'units' => 'required|integer|max:10',
            'urgency' => 'required|in:Normal,Urgent,Emergency',
            'attending_physician' => 'required|string|max:1000',
            'address' => 'required|string|max:1000',
            'hospital_id' => 'required|exists:hospital,hospital_id',
        ]);

        $bloodrequest = BloodRequest::findOrFail($id);

        $bloodrequest->update($validated);

        return redirect()->route('dashboard');
    }

    /**
     * Archive the specified resource (soft delete).
     */
    public function archive(string $id)
    {
        $bloodrequest = BloodRequest::findOrFail($id);
        $bloodrequest->delete();
        return redirect()->route('dashboard')->with('success', 'Blood request archived successfully');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function destroy(string $id)
    {
        $bloodrequest = BloodRequest::withTrashed()->findOrFail($id);
        $bloodrequest->forceDelete();
        return redirect()->route('dashboard')->with('success', 'Blood request deleted permanently');
    }

    
}
