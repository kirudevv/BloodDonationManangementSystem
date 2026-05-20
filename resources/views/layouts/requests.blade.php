<div class="bg-[#FEFFEA] w-100 flex flex-col px-6 py-6 items-start justify-start rounded-xl shadow-sm mb-3 md:w-120">
    <div class="w-full mb-4">
        <label for="blood_type" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Type</label>
        <select name="blood_type" id="blood_type" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
        <option value="{{ Auth::user()->blood_type}}" selected>{{ Auth::user()->blood_type }}</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="blood_components" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Component</label>
        <select name="blood_components" id="blood_components" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
        <option value="" disabled {{ old('blood_components') ? '' : 'selected'  }}>Choose Blood Component</option>
        <option value="Whole Blood" {{ old('blood_components') == 'Whole Blood' ? 'selected' : '' }}>Whole Blood</option>
        <option value="Platelets" {{ old('blood_components') == 'Platelets' ? 'selected' : '' }}>Platelets</option>
        <option value="Plasma" {{ old('blood_components') == 'Plasma' ? 'selected' : '' }}>Plasma</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="units" class="text-[#3A384C] font-semibold mb-1 text-sm block">Units needed</label>
        <input type="number" name="units" id="units" value="{{ old('units') }}" step="1" min="1" max="3" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="gender" class="text-[#3A384C] font-semibold mb-1 text-sm block">Gender</label>
        <select name="gender" id="gender" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            <option value="{{ Auth::user()->gender }}" selected>{{ Auth::user()->gender }}</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="urgency" class="text-[#3A384C] font-semibold mb-1 text-sm block">Urgency</label>
        <select name="urgency" id="urgency" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
        <option value="" disabled {{ old('urgency') ? '' : 'selected' }}>Select Urgency</option>
        <option value="Normal" {{ old('urgency') == 'Normal' ? 'selected' : '' }}>Normal</option>
        <option value="Urgent" {{ old('urgency') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
        <option value="Emergency" {{ old('urgency') == 'Emergency' ? 'selected' : '' }}>Emergency</option>
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="attending_physician" class="text-[#3A384C] font-semibold mb-1 text-sm block">Attending Physician</label>
        <input type="text" name="attending_physician" id="attending_physician" value="{{ old('attending_physician') }}" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transiion duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="address" class="text-[#3A384C] font-semibold mb-1 text-sm block">Address</label>
        <input type="address" name="address" id="address" value="{{ old('address') }}" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transiion duration-300">
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
    





    <button type="submit" class="w-full py-3 bg-[#A93232] text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 shadow-md">Submit</button>
</div>