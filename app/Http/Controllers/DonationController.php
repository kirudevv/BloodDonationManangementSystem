<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use App\Enum\DonateStatus;
use App\Models\Hospital;
use App\Models\BloodRequest;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationController extends Controller
{
    use SoftDeletes;

    protected $primaryKey = 'donation_id';
        
    protected $casts = [
        'status' => DonateStatus::class,
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::paginate(20, ['*'], 'userspage');
        $hospitals = Hospital::paginate(20, ['*'], 'hospitalspage');
        $donations = Donation::with(['user' => function($query){$query->withTrashed();}])->paginate(20, ['*'], 'donationspage');
        $bloodrequests = BloodRequest::with(['user', 'hospital'])->paginate(20, ['*'], 'requesetspage');
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

        if ($user->role === 'admin'){
            return view('admin.dashboard', compact('donations', 'hospitals', 'bloodrequests', 'users', 'appointments', 'inventory'));

        } elseif ($user->role === 'staff') {
            return view('staff.dashboard', compact('donations', 'hospitals', 'bloodrequests', 'users', 'appointments', 'inventory'));

        } elseif ($user->role === 'hospital_staff') {
            return view('hospital_Staff.dashboard', compact('donations', 'hospitals', 'bloodrequests', 'users', 'appointments', 'inventory'));

        } else {
            return view('users.dashboard', compact('donations', 'hospitals', 'bloodrequests', 'users', 'user', 'donacion', 'appointments', 'inventory'));
            
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('transaction', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'blood_components' => 'required|in:Whole Blood,Platelets,Plasma',
            'units_donated' => 'required|integer|max:10',
            'hemoglobin_level' => 'required|numeric|between:5,25',
            'donation_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'weight_kg' => 'required|numeric|min:45',
            'last_donation_date' => 'nullable|date|before:today',
            'medical_condition' => 'nullable|string|max:1000',
            'hospital_id' => 'required|exists:hospital,hospital_id'
            
        ]);

        Donation::create([
            'user_id' => Auth::id(),
            'blood_type' => Auth::user()->blood_type,
            'blood_components' => $request->blood_components,
            'units_donated' => $request->units_donated,
            'hemoglobin_level' => $request->hemoglobin_level,
            'donation_date' => $request->donation_date,
            'gender' => Auth::user()->gender,
            'weight_kg' => $request->weight_kg,
            'last_donation_date' => $request->last_donation_date,
            'medical_condition' => $request->medical_condition,
            'hospital_id' => $request->hospital_id,
            'status'=> 'Screening',
        ]);

        return redirect()->route('dashboard');
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
        $donation = Donation::where('donation_id', $id)->firstOrFail();
        $donations = Donation::all();
        return view('users.editdonation', compact('donation', 'donations'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'blood_components' => 'required|in:Whole Blood,Platelets,Plasma',
            'units_donated' => 'required|integer|max:10',
            'hemoglobin_level' => 'required|numeric|between:5,25',
            'donation_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'weight_kg' => 'required|numeric|min:45',
            'last_donation_date' => 'nullable|date|before:today',
            "medical_condition" => 'nullable|string|max:1000',
        ]);

        $donation = Donation::findOrFail($id);

        $donation->update($validated);

        return redirect()->route('dashboard')->with('success', 'Updated successfully');
        
    }

    /**
     * Archive the specified resource (soft delete).
     */
    public function archive(string $id)
    {
        $donations = Donation::where('donation_id', $id)->firstOrFail();
        $donations->delete();
        return redirect()->route('dashboard')->with('success', 'Donation archived successfully');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function destroy(string $id)
    {
        $donations = Donation::withTrashed()->where('donation_id', $id)->firstOrFail();
        $donations->forceDelete();
        return redirect()->route('dashboard')->with('success', 'Donation deleted permanently');
    }


    public function updateStatus(Request $request, string $id)
{
        // 1. Fix the variable name mismatch
        $user = Auth::user(); 

        // 2. Check authorization
        if (!in_array($user->role, ['admin', 'staff'])) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        // 3. Sync validation with your Blade options ('Accepted' instead of 'Approved')
        $request->validate([
            'status' => 'required|in:Screening,Approved,Rejected',      
        ]);

        $donation = Donation::findOrFail($id);

        // 4. Perform the update
        $donation->update([
            'status' => $request->status
        ]);

        return redirect()->route('dashboard')->with('success', 'Status updated successfully');
}
    public function showArchive(){
        
        $archived = Donation::onlyTrashed()->with(['user' => function($query){$query->withTrashed();}])->paginate(20, ['*'], 'archivespage');
        return view('admin.archived', compact('archived'));
    }

    public function restore(string $id){
        $archived = Donation::withTrashed()->where('donation_id', $id)->firstOrFail();
        $archived->restore();
        return redirect()->route('dashboard');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function approveDonation($id) 
    {
        // Find the record using the Eloquent Model
        $donation = Donation::find($id);
        
        // Change the status property
        $donation->status = 'Approved';
        
        // This exact save() method is what screams to the DonationObserver to fire!
        $donation->save(); 

        return redirect()->back()->with('success', 'Donation approved and appointment scheduled!');
    }
}
