@extends('layouts.app')
@section('content')
    <img src='images/logo1.png' alt="Logo" class="h-30 mb-3 mt-50 md:h-86 md:md-6 md:mt-10">
    <h1 class="text-xl text-center font-bold text-[#A93232] md:text-6xl md:text-center ">BloodLink: Blood Donation Management System</h1>
    <div class='flex gap-x-3 justify-center '>
        <a href="@guest {{ route('login') }} @endguest @auth {{ route('transaction.create') }} @endauth"
            class="mt-3 px-20 py-2 bg-[#A93232] text-xl text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 md:mt-6 md:px-50 md:py-5 md:text-2xl">
            Get Started!
        </a>
    </div>
@endsection