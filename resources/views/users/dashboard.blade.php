@extends('layouts.app')
@section('base')
@endsection
@section('content')
    @auth
    
        <h1 class="text-3xl text-[#3A384C] font-bold just py-1 md:text-6xl">Welcome! {{ Auth::user()->first_name}} </h1>
        <h1 class="text-xl text-[#3A384C] font-bold just px-2 py-1 md:text-3xl">{{ Auth::user()->role}} </h1>

        <a href="@auth {{ route('logout') }} @endauth"
            class="mt-3 mb-3 px-25 py-2 bg-[#A93232] text-xl text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 md:px-50 md:py-5">
            Logout
        </a>
        <div class="flex w-100 flex-wrap justify-center border mt-3 toggle-container bg-[#FEFFEA] rounded-3xl px-2 py-2 md:w-190">
            <div class="inline-block">
                <input type="radio" name="toggle" id="fielduser" value="fielduser" onchange="toggle()" class="hidden peer"checked>
                <label for="fielduser" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Account Information</label>
            </div>
            
            <div class="inline-block">
                <input type="radio" name="toggle" id="tabledonation" value="tabledonation" onchange="toggle()" class="hidden peer">
                <label for="tabledonation" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Donations</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="tablerequests" value="tablerequests" onchange="toggle()" class="hidden peer">
                <label for="tablerequests" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Requests</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="tableappointments" value="tableappointments" onchange="toggle()" class="hidden peer">
                <label for="tableappointments" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Appointments</label>
            </div>

            

            
        </div>

        @if(session('success'))
            <div class="w-70 mt-6 mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center mx-auto">
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
        
        <form action="{{ route('user.update', Auth::user()->user_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div id="userinformation" class="mt-3 mb-6 bg-[#FEFFEA] p-6 rounded-3xl shadow-md hidden flex flex-col items-center">
                <div class="w-70 space-y-4 md:w-200">
                    @foreach(['first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name', 'gender' => 'Gender', 'date_of_birth' => 'Date of Birth', 'email' => 'Email', 'contact_info' => 'Contact Info'] as $field => $label)
                        <div class="flex flex-col">
                            <label class="text-gray-700 font-semibold">{{ $label }}</label>
                            <input type="text" name="{{ $field }}" value="{{ Auth::user()->$field }}" class="border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DE6262] bg-[#e6e6e6]">
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="mt-6 px-10 py-3 bg-[#DE6262] text-[#feffea] rounded-xl hover:bg-[#A93232] font-semibold transition duration-300">
                    Update Account
                </button>
            </div>
        </form>
            
        <div class="bg-[#DE6262] px-3 items-center justify-center rounded-4xl shadow-md mt-3 mb-6 ">
            
            <div id="donationtable" class="py-4 w-100 md:w-200 overflow-x-auto hidden">
                <div class="flex py-3 items-end justify-between">
                    <a href="{{ route('donation.archives') }}" class="w-50 mt-4 px-2 py-1 bg-[#FEFFEA] text-xl text-[#A93232] font-semibold rounded-xl hover:bg-[#E6E6E6] transition duration-300">archives</a>
                </div>
                @include('users.tables.donations')
            </div>

            <div id="requesttable" class="py-4 w-100 md:w-200 overflow-x-auto hidden">
                @include('users.tables.requests')
            </div>

            <div id="appointmentstable" class="py-4 w-100 md:w-200 overflow-x-auto hidden">
                @include('users.tables.appointments')
            </div>

        </div>

        <script>
            function toggle(){
                const userCheck = document.getElementById('fielduser').checked;
                const DonateCheck = document.getElementById('tabledonation').checked;
                const RequestCheck = document.getElementById('tablerequests').checked;
                const AppCheck = document.getElementById('tableappointments').checked;

                const userinfo = document.getElementById('userinformation');
                const dtable = document.getElementById('donationtable');
                const rtable = document.getElementById('requesttable');
                const atable = document.getElementById('appointmentstable');
                
                userinfo.classList.add('hidden');
                dtable.classList.add('hidden');
                rtable.classList.add('hidden');
                atable.classList.add('hidden');
                
                if(userCheck){
                    userinfo.classList.remove('hidden');

                } else if (DonateCheck){
                    dtable.classList.remove('hidden');

                } else if (RequestCheck){
                    rtable.classList.remove('hidden');

                } else if (AppCheck){
                    atable.classList.remove('hidden');
                };
            };

            document.addEventListener('DOMContentLoaded', function(){
                toggle();
            });
        </script>

        
    @endauth
@endsection