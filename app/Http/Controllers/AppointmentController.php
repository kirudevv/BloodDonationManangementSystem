<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Donation;
use App\Models\BloodRequest;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     * Filtered by Hospital for Hospital Staff.
     */
    public function index()
    {
        $user = Auth::user();
        
        // 1. Fetch Inventory with your Hospital Scoping
        $inventoryQuery = Inventory::with(['donation.user', 'donation.hospital']);

        if ($user->role === 'hospital_staff') {
            $inventoryQuery->whereHas('donation', function ($q) use ($user) {
                $q->where('hospital_id', $user->hospital_id);
            });
        }
        $inventory = $inventoryQuery->latest()->paginate(20, ['*'], 'inventorypage');

        $users = User::paginate(20, ['*'], 'userspage');
        $hospitals = Hospital::paginate(20, ['*'], 'hospitalspage');
        $donations = Donation::with('user')->latest()->paginate(20, ['*'], 'donationspage');
        $bloodrequests = BloodRequest::with('user')->latest()->paginate(20, ['*'], 'requesetspage');


        // 2. Fetch your other existing variables
        $appointments = Appointment::with(['user', 'hospital', 'donation', 'bloodRequest'])
            ->when($user->role === 'hospital_staff', function($q) use ($user) {
                return $q->where('hospital_id', $user->hospital_id);
            })
            ->latest()->paginate(20, ['*'], 'appointmentsspage');

        // 3. PASS EVERYTHING TO THE VIEW
        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('appointments', 'inventory', 'users', 'hospitals', 'donations', 'bloodrequests'));
        } 
        
        $donacion = Donation::where('user_id', Auth::id())->paginate(20, ['*'], 'donacionspage');
        return view('users.dashboard', compact('appointments', 'inventory', 'users', 'hospitals', 'bloodrequests', 'donations', 'donacion'));
    }
    /**
     * Show the form for editing an appointment status.
     */
    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $user = Auth::user();

        // UNAUTHORIZED CHECK: Prevent staff from editing other hospitals
        if ($user->role === 'hospital_staff' && $appointment->hospital_id !== $user->hospital_id) {
            abort(403, 'You do not have permission to edit this appointment.');
        }

        return view('users.editappointment', compact('appointment'));
    }

    public function update(Request $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Scheduled,Completed,No-show,Cancelled',
        ]);

        // When this update runs, the AppointmentObserver 'updated' method is triggered.
        $appointment->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Appointment status updated! If completed, inventory has been updated.');
    }

    /**
     * Remove the specified appointment (Soft Delete).
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Appointment has been archived.');
    }

    public function completeAppointment($id) 
    {
        // Find the record using the Eloquent Model
        $appointment = Appointment::find($id);
        
        // Change the status property
        $appointment->status = 'Completed';
        
        // This exact save() method is what screams to the AppointmentObserver to fire!
        $appointment->save(); 

        return redirect()->back()->with('success', 'Appointment marked as completed and inventory updated!');
    }
}