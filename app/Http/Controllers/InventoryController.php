<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Donation;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Reverting to all()
        $users = User::paginate(20, ['*'], 'userspage');
        $hospitals = Hospital::paginate(20, ['*'], 'hospitalspage');
        $donations = Donation::with('user')->latest()->paginate(20, ['*'], 'donationspage');
        $bloodrequests = BloodRequest::with(['user', 'hospital'])->latest()->paginate(20, ['*'], 'requesetspage');
        
        // 1. FETCH INVENTORY (With hospital restrictions)
        $inventoryQuery = Inventory::with(['donation.user', 'donation.hospital']);

        if ($user->role === 'hospital_staff') {
            // Staff only see inventory from THEIR hospital
            $inventoryQuery->whereHas('donation', function ($q) use ($user) {
                $q->where('hospital_id', $user->hospital_id);
            });
        }
        $inventory = $inventoryQuery->latest()->paginate(20, ['*'], 'inventorypage');

        $query = Appointment::with(['user', 'hospital', 'donation', 'bloodRequest']);
        if ($user->role === 'hospital_staff') {
            $query->where('hospital_id', $user->hospital_id);
        }
        $appointments = $query->latest()->paginate(20, ['*'], 'appointmentsspage');


        if ($user->role === 'admin') {
            return view('admin.dashboard', compact(
                'appointments', 
                'users', 
                'hospitals', 
                'donations', 
                'bloodrequests',
                'inventory'
            ));
        } 
        else if ($user->role === 'user') {
            return view('users.dashboard', compact(
                'appointments', 
                'users', 
                'user', 
                'hospitals', 
                'bloodrequests', 
                'donations',
                'inventory'
            ));
        }

        return abort(403, 'Unauthorized action.');
    }

    public function grantBlood(Request $request, $id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);

        // Use the specific inventory item selected in the modal
        if ($request->filled('inventory_id')) {
            $unit = Inventory::where('inventory_id', $request->inventory_id)
                ->where('blood_type', $bloodRequest->blood_type)
                ->where('blood_components', $bloodRequest->blood_components)
                ->where('status', 'Available')
                ->first();
        } else {
            // Fallback: find any available matching unit
            $unit = Inventory::where('blood_type', $bloodRequest->blood_type)
                ->where('blood_components', $bloodRequest->blood_components)
                ->where('status', 'Available')
                ->first();
        }

        if (!$unit) {
            return redirect()->route('dashboard')->with('error', 'No matching blood units available in inventory.');
        }

        $unit->update(['status' => 'Granted']);
        $unit->delete(); // Move to archives/history
        $bloodRequest->update(['status' => 'Approved']);

        return redirect()->route('dashboard')->with('success', 'Blood successfully granted for request.');
    }

    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);
        $item->update(['status' => 'Archived']);
        $item->delete();
        return redirect()->route('dashboard')->with('success', 'Unit moved to archives.');
    }

    public function showArchive()
    {
        $user = Auth::user();
        $query = Inventory::onlyTrashed()->with(['donation.user', 'donation.hospital']);

        if ($user->role === 'hospital_staff') {
            $query->whereHas('donation', function ($q) use ($user) {
                $q->where('hospital_id', $user->hospital_id);
            });
        }

        $archived = $query->latest()->paginate(20, ['*'], 'inventoryarchivespage');
        return view('tables.inventory_archive', compact('archived'));
    }

    public function restore($id)
    {
        $item = Inventory::withTrashed()->findOrFail($id);
        $item->restore();
        $item->update(['status' => 'Available']);
        return redirect()->route('dashboard')->with('success', 'Unit restored to inventory.');
    }
}