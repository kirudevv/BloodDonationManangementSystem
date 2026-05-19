<div class="bg-[#FEFFEA] w-120 flex flex-col flex-grow px-5 py-5 items-center justify-center rounded-xl shadow-sm">
    <div class="flex flex-col w-full">
        <label for="email" class="text-[3A384C] font-semibold mb-1 text-sm">Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email', $users->email) }}" placeholder="yourname@gmail.com" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('email') border-red-300 @enderror">
    </div>
    


    <div class="w-full mb-4">
        <label for="first_name" class="text-[#3A384C] font-semibold mb-1 text-sm">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $users->first_name) }}" placeholder="Jessica" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('first_name') border-red-300 @enderror">
    </div>
    
    <div class="w-full mb-4">
        <label for="las_name" class="text-[#3A384C] font-semibold mb-1 text-sm">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $users->last_name) }}" placeholder="Summers" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('last_name') border-red-300 @enderror">

    </div>
    

    <div class="w-full mb-4">
        <label for="middle_name" class="text-[#3A384C] font-semibold mb-1 text-sm">Middle Name</label>
        <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $users->middle_name) }}" placeholder="Clove" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('middle_name') border-red-300 @enderror">
    </div>

    <div class="w-full mb-4">
        <label for="date_of_birth" class="text-[#3A384C] font-semibold mb-1 text-sm">Date of Birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $users->date_of_birth) }}" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('date_of_birth') border-red-300 @enderror">
    </div>
    <div class="w-full mb-4">
        @error('date_of_birth')
            <p class="text-red-600 text-xs mt-1">{{ $message == 'Age requirement not met. ' ? 'Must be 18 or above!' : $message}}</p>
        @enderror
    </div>
    <div class="w-full mb-4">
        <label for="blood_type" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Type</label>
        <select name="blood_type" id="blood_type" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $type) 
            <option value="{{ $type }}" {{ old('blood_type', $users->blood_type) == $type ? 'selected' : ''}}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full mb-4">
        <label for="role" class="text-[#3A384C] font-semibold mb-1 text-sm">Role</label>
        <select 
            name="role" 
            id="role" 
            
            required 
            class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            @foreach(['user', 'admin', 'staff', 'hospital staff'] as $role)
            <option value="{{ $role }}" {{ old('role', $users->role) == $role ? 'selected' : '' }}>{{ $role }}</option>
            @endforeach
        </select>

        @error('role')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="w-full mb-4">
        <label for="gender" class="text-[#3A384C] font-semibold mb-1 text-sm block">Gender</label>
        <select name="gender" id="gender" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
            @foreach(['Male', 'Female'] as $genders)
            <option value="{{ $genders }}" {{ old('gender') == $genders ? 'selected' : ''}}>{{ $genders }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full mb-4">
        <label for="contact_info" class="text-[#3A384C] font-semibold mb-1 text-sm">Contact Info</label>
        <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info', $users->contact_info) }}" placeholder="09999999999" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none tranistion duration-300 @error('contact_info') border-red-300 @enderror">
    </div>

    <div class="w-full mb-4">
        <label for="password" class= "text-[#3A384C] font-semibold mb-1 text-sm">Password</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('password') border-red-300 @enderror">
    </div>

    <div class="w-full mb-4">
        <label for="password_confirmed" class= "text-[#3A384C] font-semibold mb-1 text-sm">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('password_confirmation') border-red-300 @enderror">
        @error('password')
        <p class text-red-600 text-xs mt-1>
            {{ $message == 'The password field confirmation does not match.' ? 'Password Mismatch!' : $message }}
        </p>
        @enderror
    </div>

    <div class="py-3">
        <button type="submit" class="w-full px-7 py-2 padding-100 bg-[#A93232] text-2xl text-[#FEFFEA] font-semibold rounded-lg hover:bg-[#DE6262] transition duration-300">Submit</button>
    </div>

</div>