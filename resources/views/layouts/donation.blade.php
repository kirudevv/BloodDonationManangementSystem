<div class="bg-[#FEFFEA] w-100 flex flex-col px-6 py-6 items-start justify-start rounded-xl shadow-sm mb-3 md:w-120">
    
    <div class="w-full mb-4">
        <label for="blood_type" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Type</label>
        <select name="blood_type" id="blood_type" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            <option value="{{ Auth::user()->blood_type }}" selected>{{ Auth::user()->blood_type }}</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="blood_components" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Component</label>
        <select name="blood_components" id="blood_components" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            <option value="" disabled {{ old('blood_components') ? '' : 'selected'}}>Choose Blood Component</option>
            <option value="Whole Blood" {{ old('blood_components') == 'Whole Blood' ? 'selected' : '' }}>Whole Blood</option>
            <option value="Platelets" {{ old('blood_components') == 'Platelets' ? 'selected' : '' }}>Platelets</option>
            <option value="Plasma" {{ old('blood_components') == 'Plasma' ? 'selected' : '' }}>Plasma</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="units_donated" class="text-[#3A384C] font-semibold mb-1 text-sm block">Units to donate</label>
        <input type="number" name="units_donated" id="units_donated" value="{{ old('units_donated')}}" step="1" min="1" max="3" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="hemoglobin_level" class="text-[#3A384C] font-semibold mb-1 text-sm block">Hemoglobin Level</label>
        <input type="number" name="hemoglobin_level" id="hemoglobin_level" value="{{ old('hemoglobin_level')}}" step="0.01" min="1" max=20" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="donation_date" class="text-[#3A384C] font-semibold mb-1 text-sm block">Donation Date</label>
        <input type="date" name="donation_date" id="donation_date" value="{{ old('donation_date')}}" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="gender" class="text-[#3A384C] font-semibold mb-1 text-sm block">Gender</label>
        <select name="gender" id="gender" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            <option value="{{ Auth::user()->gender }}" selected>{{ Auth::user()->gender }}</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="weight_kg" class="text-[#3A384C] font-semibold mb-1 text-sm block">Weight (kg)</label>
        <input type="number" name="weight_kg" id="weight_kg" value="{{ old('weight_kg')}}" step="0.01" min="1" max="100" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="last_donation_date" class="text-[#3A384C] font-semibold mb-1 text-sm block">Last Donation Date</label>
        <input type="date" name="last_donation_date" id="last_donation_date" value="{{ old('last_donation_date')}}" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-6">
        <label for="medical_condition" class="text-[#3A384C] font-semibold mb-1 text-sm block">Medical Condition</label>
        <input type="text" name="medical_condition" id="medical_condition" value="{{ old('medical_condition')}}" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="hospital_id" class="text-[#3A384C] font-semibold mb-1 text-sm block">Hospital</label>
        <select name="hospital_id" id="hospital_id" class="w-full px-4 py-2 rounded-lg border-2 border-slat e-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            <option value="" disabled selected >Select Hospital</option>
            @foreach($hospitals as $hospital)
                <option value="{{ $hospital->hospital_id }}">{{ $hospital->hospital_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full">
        <button type="submit" class="w-full py-3 bg-[#A93232] text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 shadow-md">
            Submit
        </button>
    </div>
</div>