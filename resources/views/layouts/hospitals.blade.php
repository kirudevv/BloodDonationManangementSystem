<div class="bg-[#FEFFEA] w-100 flex flex-col px-6 py-6 items-start justify-start rounded-xl shadow-sm mb-3 md:w-120">
    <div class="w-full mb4">

    </div>

    <div class="w-full mb-4">
        <label for="hospital_name" class="text-[#3A384C] text-semibold mb-1 text-sm block">Hospital Name</label>
        <input type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name') }}" required class="bg-[#E6E6E6] rounded-lg px-4 py-2 w-full border-2 border-slate-200 focus:border-[#3A384C] focus-outline-none transition duration-300">
    </div>

    <div class="w-full mb-4">
        <label for="address" class="text-[#3a384c] text-semibold mb-1 text-sm block">Address</label>
        <input type="text" name="address" id="address" name="address" value="{{ old('address') }}" required class="bg-[#e6e6e6] rounded-lg px-4 py-2 w-full border-2 border-slate-200 focus:border-[#3a384c] focus:outline-none transition duration-300">  
    </div>

    <div class="w-full mb-4">
        <label for="contact_person" class="text-[#3a384c] text-semibold mb-1 text-sm block">Contact Person</label>
        <input type="text" name="contact_person" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required class="bg-[#e6e6e6] rounded-lg px-4 py-2 w-full border-2 border-slate-200 focus:border-[#3a384c] focus:outline-none transition duration-300">  
    </div>

    <div class="w-full mb-4">
        <label for="phone_number" class="text-[#3a384c] text-semibold mb-1 text-sm block">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required class="bg-[#e6e6e6] rounded-lg px-4 py-2 w-full border-2 border-slate-200 focus:border-[#3a384c] focus:outline-none transition duration-300">  
    </div>

    <div class="w-full mb-4">
        <label for="hospital_email" class="text-[#3a384c] text-semibold mb-1 text-sm block">Hospital Email</label>
        <input type="text" name="hospital_email" id="hospital_email" name="hospital_email" value="{{ old('hospital_email') }}" required class="bg-[#e6e6e6] rounded-lg px-4 py-2 w-full border-2 border-slate-200 focus:border-[#3a384c] focus:outline-none transition duration-300">  
    </div>

    <button type="submit" class="w-full mt-3 py-3 bg-[#A93232] text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 shadow-md">Submit</button>

</div>