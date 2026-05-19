<div class="bg-[#FEFFEA] w-120 flex flex-col px-6 py-6 items-start justify-start rounded-xl shadow-sm mb-3">

    <div class="w-full mb-4">
        <label for="blood_type" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Type</label>
        <select name="blood_type" id="blood_type" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300"> 
            <option value="{{ old('blood_type', $donation->blood_type) }}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }} selected>{{ $donation->blood_type }}</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="blood_components" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Component</label>
        <select name="blood_components" id="blood_components" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            @foreach(['Whole Blood', 'Platelets', 'Plasma'] as $components)
            <option value="{{ $components }}" {{old('blood_components', $donation->blood_components)== $components ? 'selected' : ''}} {{ Auth::user()->role === 'admin' ? 'readonly' : '' }}>{{ $components }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="units_donated" class="text-[#3A384C] font-semibold mb-1 text-sm block">Units to donate</label>
        <input type="number" name="units_donated" id="units_donated" value="{{ old('units_donated', $donation->units_donated)}}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }} step="1" min="1" max="3" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="hemoglobin_level" class="text-[#3A384C] font-semibold mb-1 text-sm block">Hemoglobin Level</label>
        <input type="number" name="hemoglobin_level" id="hemoglobin_level" value="{{ old('hemoglobin_level', $donation->hemoglobin_level) }}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }} step="0.01" min="1" max="20" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="donation_date" class="text-[#3A384C] font-semibold mb-1 text-sm block">Donation Date</label>
        <input type="date" name="donation_date" id="donation_date" value="{{ old('donation_date', $donation->donation_date) }}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }} required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="gender" class="text-[#3A384C] font-semibold mb-1 text-sm block">Gender</label>
        <select name="gender" id="gender" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            <option value="{{ old('gender', $donation->gender) }}" selected {{ Auth::user()->role === 'admin' ? 'readonly' : '' }}>{{ $donation->gender }}</option>
    
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="weight_kg" class="text-[#3A384C] font-semibold mb-1 text-sm block">Weight (kg)</label>
        <input type="number" name="weight_kg" id="weight_kg" value="{{ old('weight_kg', $donation->weight_kg )}}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }} step="0.01" min="1" max="100" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="last_donation_date" class="text-[#3A384C] font-semibold mb-1 text-sm block">Last Donation Date</label>
        <input type="date" name="last_donation_date" id="last_donation_date" value="{{ old('last_donation_date', $donation->last_donation_date )}}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }} class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-6">
        <label for="medical_condition" class="text-[#3A384C] font-semibold mb-1 text-sm block">Medical Condition</label>
        <input type="text" name="medical_condition" id="medical_condition" value="{{ old('medical_condition', $donation->medical_condition )}}" {{ Auth::user()->role === 'admin' ? 'readonly' : '' }}  class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    @if(Auth::user()->role !== 'admin' && Auth::user()->role !== 'staff')
    <div class="w-full">
        <button type="submit" class="w-full py-3 bg-[#A93232] text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 shadow-md">
            Submit
        </button>
    </div>
    @endif

</div>