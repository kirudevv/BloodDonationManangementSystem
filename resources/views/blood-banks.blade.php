@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                Partnered <span class="text-red-600">Blood Banks</span> & Hospitals
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-3">
                Find authorized blood donation centers and partner hospitals across the region.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            
            <div class="bg-white overflow-hidden shadow-md rounded-lg border border-gray-100 flex flex-col justify-between p-6 hover:shadow-lg transition-shadow duration-300">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            24/7 Active
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Brokenshire Group of Hospitals</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-start">
                        <span class="font-semibold text-gray-700 mr-1">Address:</span> Toril, Davao City, Philippines
                    </p>
                </div>
                <div class="border-t border-gray-100 pt-4 mt-4 text-sm text-gray-600 space-y-1">
                    <p><span class="font-medium text-gray-800">Contact:</span> Alvin San Augustinian</p>
                    <p><span class="font-medium text-gray-800">Phone:</span> 09887776664</p>
                    <p class="truncate"><span class="font-medium text-gray-800">Email:</span> brokenshiredcgroup@gmail.com</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-md rounded-lg border border-gray-100 flex flex-col justify-between p-6 hover:shadow-lg transition-shadow duration-300">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            Regional Center
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Southern Philippines Medical Center</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-start">
                        <span class="font-semibold text-gray-700 mr-1">Address:</span> Bajada, Davao City, 8000
                    </p>
                </div>
                <div class="border-t border-gray-100 pt-4 mt-4 text-sm text-gray-600 space-y-1">
                    <p><span class="font-medium text-gray-800">Contact:</span> Julie Masangcay</p>
                    <p><span class="font-medium text-gray-800">Phone:</span> 09542231515</p>
                    <p class="truncate"><span class="font-medium text-gray-800">Email:</span> smpcgroup@gmail.com</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-md rounded-lg border border-gray-100 flex flex-col justify-between p-6 hover:shadow-lg transition-shadow duration-300">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            Main Facility
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Davao Doctors Medical Center</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-start">
                        <span class="font-semibold text-gray-700 mr-1">Address:</span> Kanto Bunawan Road, Davao City, 8000
                    </p>
                </div>
                <div class="border-t border-gray-100 pt-4 mt-4 text-sm text-gray-600 space-y-1">
                    <p><span class="font-medium text-gray-800">Contact:</span> Jane Hermosa Danques</p>
                    <p><span class="font-medium text-gray-800">Phone:</span> 09777777777</p>
                    <p class="truncate"><span class="font-medium text-gray-800">Email:</span> davaodoctorsgroup@gmail.com</p>
                </div>
            </div>

        </div>
    </div>
@endsection