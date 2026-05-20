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
                <input type="radio" name="toggle" id="tabledonation" value="tabledonation" onchange="toggle()" class="hidden peer" checked>
                <label for="tabledonation" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Donations</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="tablerequests" value="tablerequests" onchange="toggle()" class="hidden peer">
                <label for="tablerequests" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Requests</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="tableusers" value="tableusers" onchange="toggle()" class="hidden peer">
                <label for="tableusers" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">User</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="hospitalfields" value="hospitalfields" onchange="toggle()" class="hidden peer">
                <label for="hospitalfields" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Hospitals</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="appointment" value="appointment" onchange="toggle()" class="hidden peer">
                <label for="appointment" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Appointments</label>
            </div>

            <div class="inline-block">
                <input type="radio" name="toggle" id="inventory" value="inventory" onchange="toggle()" class="hidden peer">
                <label for="inventory" class="text-[#DE6262] px-6 cursor-pointer peer-checked:text-[#feffea] peer-checked:bg-[#de6262] peer-checked:rounded-2xl">Inventory</label>
            </div>
        </div>


        <div class="bg-[#DE6262] w-300 flex flex-col max-w-full overflow-x-auto px-3 justify-center rounded-4xl shadow-md mt-3 mb-6 md:w-350">
            <div id="donationtable" class="py-4 hidden">
                <div class="flex py-3 items-end justify-between">
                    <a href="{{ route('donation.archives') }}"
                        class="w-23 mt-4 px-2 py-1 bg-[#FEFFEA] text-xl text-[#A93232] font-semibold rounded-xl hover:bg-[#E6E6E6] transition duration-300">archives</a>
                </div>
                @include('tables.donations')
            </div>

            <div id="requesttable" class="py-4 hidden">
                @include('tables.bloodrequests')
            </div>

            <div id="usertable" class=" py-4 hidden">
                @include('tables.users')
            </div>

            <div id="hospital" class="py-4 hidden space-y-5">

                <div class="flex py-3 items-end justify-between">
                    <a href="{{ route('hospital.create') }}"
                        class="w-33 mt-4 px-2 py-1 bg-[#FEFFEA] text-xl text-[#A93232] font-semibold rounded-xl hover:bg-[#E6E6E6] transition duration-300">add
                        hospital</a>
                </div>

                @include('tables.hospital')

            </div>

            <div id="appointments" class="py-4 hidden space-y-5">

                @include('tables.appointments')

            </div>

            <div id="inventorytable" class="py-4 hidden space-y-5">

                @include('tables.inventory')

            </div>
        </div>




        <script>
            function toggle() {
                const DonateCheck = document.getElementById('tabledonation').checked;
                const HospitalCheck = document.getElementById('hospitalfields').checked;
                const RequestCheck = document.getElementById('tablerequests').checked;
                const UserCheck = document.getElementById('tableusers').checked;
                const AppCheck = document.getElementById('appointment').checked;
                const InventoryCheck = document.getElementById('inventory').checked;

                const dtable = document.getElementById('donationtable');
                const hospitals = document.getElementById('hospital');
                const rtable = document.getElementById('requesttable');
                const utable = document.getElementById('usertable');
                const atable = document.getElementById('appointments');
                const itable = document.getElementById('inventorytable');

                dtable.classList.add('hidden');
                hospitals.classList.add('hidden');
                rtable.classList.add('hidden');
                utable.classList.add('hidden');
                atable.classList.add('hidden');
                itable.classList.add('hidden');


                if (DonateCheck) {
                    dtable.classList.remove('hidden');

                } else if (HospitalCheck) {
                    hospitals.classList.remove('hidden');

                } else if (RequestCheck) {
                    rtable.classList.remove('hidden');

                } else if (UserCheck) {
                    utable.classList.remove('hidden');

                } else if (AppCheck) {
                    atable.classList.remove('hidden');
                } else if (InventoryCheck) {
                    itable.classList.remove('hidden');
                };
            };

            document.addEventListener('DOMContentLoaded', function () {
                toggle();
            });
        </script>


    @endauth
@endsection