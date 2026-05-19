<hr class="border-t-2 border-[#DE6262] my-6">
<h1 class="text-3xl font-bold text-center mb-10">
    <a href="#" class="text-[#3A384C] transition duration-300">
        Authentication
    </a>
</h1>

<div class="flex flex-col w-full mb-8">
    <label for="email" class="text-[#3A384C] font-semibold mb-2 text-lg">Email Address</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="yourname@gmail.com" required class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('email') border-red-300 @enderror">
</div>

<div class="w-full mb-8">
    <label for="password" class="text-[#3A384C] font-semibold mb-2 text-lg">Password (Leave blank to keep current)</label>
    <input type="password" name="password" id="password" placeholder="Enter New Password" class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('password') border-red-300 @enderror">
</div>

<div class="w-full mb-8">
    <label for="password_confirmation" class="text-[#3A384C] font-semibold mb-2 text-lg">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password" class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] shadow-lg focus:outline-none transition duration-300">
    @error('password')
        <p class="text-red-600 text-sm mt-2">
            {{ $message == 'The password field confirmation does not match.' ? 'Password Mismatch!' : $message }}
        </p>
    @enderror
</div>

<hr class="border-t-2 my-6 border-[#DE6262] mt-24">
<h1 class="text-3xl font-bold text-center mb-10">
    <a href="#" class="text-[#3A384C] hover:text-[#DE6262] transition duration-300">
        Personal Details
    </a>
</h1>

<div class="w-full mb-8">
    <label for="first_name" class="text-[#3A384C] font-semibold mb-2 text-lg">First Name</label>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Jessica" required class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('first_name') border-red-300 @enderror">
</div>

<div class="w-full mb-8">
    <label for="last_name" class="text-[#3A384C] font-semibold mb-2 text-lg">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Summers" required class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('last_name') border-red-300 @enderror">
</div>

<div class="w-full mb-8">
    <label for="middle_name" class="text-[#3A384C] font-semibold mb-2 text-lg">Middle Name</label>
    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $user->middle_name) }}" placeholder="Clove" class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('middle_name') border-red-300 @enderror">
</div>

<div class="w-full mb-8">
    <label for="date_of_birth" class="text-[#3A384C] font-semibold mb-2 text-lg">Date of Birth</label>
    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('date_of_birth') border-red-300 @enderror">
</div>

<div class="w-full mb-8">
    <label for="blood_type" class="text-[#3A384C] font-semibold mb-2 text-lg block">Blood Type</label>
    <select name="blood_type" id="blood_type" required class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg">
        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $type) 
            <option value="{{ $type }}" {{ old('blood_type', $user->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
</div>

<div class="w-full mb-8">
    <label for="gender" class="text-[#3A384C] font-semibold mb-2 text-lg block">Gender</label>
    <select name="gender" id="gender" required class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg">
        @foreach(['Male', 'Female'] as $genderOption)
            <option value="{{ $genderOption }}" {{ old('gender', $user->gender) == $genderOption ? 'selected' : '' }}>{{ $genderOption }}</option>
        @endforeach
    </select>
</div>

<div class="w-full mb-8">
    <label for="contact_info" class="text-[#3A384C] font-semibold mb-2 text-lg">Contact Info</label>
    <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info', $user->contact_info) }}" placeholder="09999999999" required class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 shadow-lg @error('contact_info') border-red-300 @enderror">
</div>

<hr class="border-t-2 my-6 border-[#DE6262] mt-24">
<h1 class="text-3xl font-bold text-center mb-10">
    <a href="#" class="text-[#3A384C] hover:text-[#DE6262] transition duration-300">
        Account Type
    </a>
</h1>

<div class="w-full mb-12">
    <label for="role" class="text-[#3A384C] font-semibold mb-2 text-lg">Role</label>
    <select id="role_display" disabled class="w-full px-4 py-4 text-xl rounded-lg border-2 border-slate-200 bg-slate-300 cursor-not-allowed shadow-lg">
        @foreach(['user', 'admin', 'staff', 'hospital_staff'] as $role)
            <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                {{ ucwords(str_replace('_', ' ', $role)) }}
            </option>
        @endforeach
    </select>
    <input type="hidden" name="role" value="{{ old('role', $user->role) }}">
</div>

<div class="py-10">
    <button type="submit" class="w-full px-7 py-4 bg-[#DE6262] text-3xl text-[#FEFFEA] font-bold rounded-lg hover:bg-[#A93232] transition duration-300 shadow-xl">
        Update Profile
    </button>
</div>