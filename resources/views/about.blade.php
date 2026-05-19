@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-base text-red-600 font-semibold tracking-wide uppercase">Our Mission</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Bridging the Gap Between Donors and Patients
            </p>
            <p class="mt-4 text-lg text-gray-500">
                The Blood Donation Management System (BDMS) is a dedicated digital network built to streamline medical emergency logistics, automate blood inventory updates tracking shelf-lives safely, and optimize communications across Mindanao facilities.
            </p>
        </div>

        <div class="mt-10 mb-20">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10 text-center">
                
                <div class="flex flex-col bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">Verified Donors</dt>
                    <dd class="order-1 text-5xl font-extrabold text-red-600">10,000+</dd>
                </div>

                <div class="flex flex-col bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">Partner Hospitals</dt>
                    <dd class="order-1 text-5xl font-extrabold text-red-600">3 Main</dd>
                </div>

                <div class="flex flex-col bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">Storage Lifespan</dt>
                    <dd class="order-1 text-5xl font-extrabold text-red-600">42 Days</dd>
                </div>
                
            </dl>
        </div>

        <div class="bg-red-700 rounded-2xl shadow-xl overflow-hidden lg:grid lg:grid-cols-2 lg:gap-4 p-8 lg:p-12 items-center">
            <div class="text-white">
                <h3 class="text-2xl font-extrabold sm:text-3xl">System Integrity & Tracking</h3>
                <p class="mt-3 text-lg text-red-100">
                    Our platform utilizes live web application listeners to handle background resource mapping natively. Status modifications automatically cycle data rows straight through user profile screening, hospital allocations, and historical logging configurations seamlessly.
                </p>
            </div>
            <div class="mt-10 lg:mt-0 flex justify-center lg:justify-end">
                <span class="inline-flex rounded-md shadow">
                    <div class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-red-700 bg-white hover:bg-red-50">
                        BDMS v1.0 Live
                    </div>
                </span>
            </div>
        </div>

    </div>
@endsection