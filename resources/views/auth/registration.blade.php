<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @extends('layouts.app')
    @section('base')
    @section('content')
        <h1 class="font-semibold text-3xl py-5 text-[#3A384C]">Create Account</h1>
            <div class="bg-[#FEFFEA] w-95 flex flex-col flex-grow px-5 py-5 mb-4 items-center justify-center rounded-xl shadow-sm md:w-120 ">
                @if(session('success'))
                    <div class="w-200 mt-6 mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-lg font-bold text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('registration.store')}}" method="POST" class="space-y-4 w-full max-w-md px-4">
                    @csrf
                    <div class="flex flex-col w-full">
                        <label for="email" class="text-[3A384C] font-semibold mb-1 text-sm">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="yourname@gmail.com" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('email') border-red-300 @enderror">
                    </div>
                    


                    <div>
                        <label for="first_name" class="text-[#3A384C] font-semibold mb-1 text-sm">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Jessica" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('first_name') border-red-300 @enderror">
                    </div>
                    
                    <div>
                        <label for="last_name" class="text-[#3A384C] font-semibold mb-1 text-sm">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Summers" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('last_name') border-red-300 @enderror">

                    </div>
                    

                    <div>
                        <label for="middle_name" class="text-[#3A384C] font-semibold mb-1 text-sm">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" placeholder="Clove" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('middle_name') border-red-300 @enderror">
                    </div>

                    <div>
                        <label for="date_of_birth" class="text-[#3A384C] font-semibold mb-1 text-sm">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('date_of_birth') border-red-300 @enderror">
                    </div>
                    <div>
                        @error('date_of_birth')
                            <p class="text-red-600 text-xs mt-1">{{ $message == 'Age requirement not met. ' ? 'Must be 18 or above!' : $message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="blood_type" class="text-[#3A384C] font-semibold mb-1 text-sm block">Blood Type</label>
                        <select name="blood_type" id="blood_type" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
                            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $type) 
                            <option value="{{ $type }}" {{ old('blood_type') == $type ? 'selected' : ''}}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="role" class="text-[#3A384C] font-semibold mb-1 text-sm">Role</label>
                        <select 
                            name="role" 
                            id="role" 
                            onchange="toggle()"
                            required 
                            class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
                            
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : ''}}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Admin</option>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : ''}}>Staff</option>
                            <option value="hospital_staff" {{ old('role') == 'hospital_staff' ? 'selected' : ''}}>Hospital Staff</option>
                        </select>

                        

                        @error('role')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="hospital" class="hidden">
                        <label for="hospital_id" class="text-[#3A384C] font-semibold mb-1 text-sm block">Hospital</label>
                        <select name="hospital_id" id="hospital_id" class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
                            <option value="" disabled selected >Select Hospital</option>
                            @foreach($hospitals as $hospital)
                                <option value="{{ $hospital->hospital_id }}">{{ $hospital->hospital_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <script>
                        function toggle(){
                            const rolebutton = document.getElementById('role').value;
                            const hospitalfield = document.getElementById('hospital');
                            
                            if(rolebutton === "hospital_staff"){
                                hospitalfield.classList.remove('hidden');
                            }else{
                                hospitalfield.classList.add('hidden');
                            }
                        }
                        toggle();
                    </script>
                    
                    <div>
                        <label for="gender" class="text-[#3A384C] font-semibold mb-1 text-sm block">Gender</label>
                        <select name="gender" id="gender" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
                            @foreach(['Male', 'Female'] as $genders)
                            <option value="{{ $genders }}" {{ old('gender', $user->gender ?? '') == $genders ? 'selected' : '' }}>{{ $genders }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="contact_info" class="text-[#3A384C] font-semibold mb-1 text-sm">Contact Info</label>
                        <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info') }}" placeholder="09999999999" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none tranistion duration-300 @error('contact_info') border-red-300 @enderror">
                    </div>

                    <div>
                        <label for="password" class= "text-[#3A384C] font-semibold mb-1 text-sm">Password</label>
                        <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password"required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('password') border-red-300 @enderror">
                    </div>

                    <div>
                        <label for="password_confirmed" class= "text-[#3A384C] font-semibold mb-1 text-sm">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error('password_confirmation') border-red-300 @enderror">
                        @error('password')
                        <p class text-red-600 text-xs mt-1>
                            {{ $message == 'The password field confirmation does not match.' ? 'Password Mismatch!' : $message }}
                        </p>
                        @enderror
                    </div>
        
                    <div class="py-3">
                        <button type="submit" class="w-full py-3 padding-100 bg-[#A93232] text-2xl text-[#FEFFEA] font-semibold rounded-lg hover:bg-[#DE6262] transition duration-300">Create Account</button>
                    </div>
                
                </form>
            </div>
    @endsection
    @endsection
</body>
</html>