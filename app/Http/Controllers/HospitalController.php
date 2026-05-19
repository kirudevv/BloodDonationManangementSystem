<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::paginate(20, ['*'], 'hospitalspage');
        return view('admin.dashboard', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('admin.hospitaladd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'hospital_name' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'contact_person' => 'required|string|max:100',
            'phone_number' => 'required|string|max:50',
            'hospital_email' => 'required|email|unique:hospital,hospital_email',
        ]);

        Hospital::create([
            'hospital_name' => $request->hospital_name,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'phone_number' => $request->phone_number,
            'hospital_email' => $request->hospital_email
        ]);

        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('hospitals');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hospitals = Hospital::where('hospital_id', $id)->firstOrFail();
        return view('admin.edithospital', compact('hospitals'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'hospital_name' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'contact_person' => 'required|string|max:100',
            'phone_number' => 'required|string|max:50',
            'hospital_email' => 'required|email|unique:hospital,hospital_email',
        ]);

        $hospitals = Hospital::findOrFail($id);

        $hospitals->update($validated);
        return redirect()->route('dashboard');
    }

    /**
     * Archive the specified resource (soft delete).
     */
    public function archive(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
        return redirect()->route('dashboard')->with('success', 'Hospital archived successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::withTrashed()->findOrFail($id);
        $hospital->forceDelete();
        return redirect()->route('dashboard')->with('success', 'Hospital deleted permanently');
    }
}
