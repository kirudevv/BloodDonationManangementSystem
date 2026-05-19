@extends('layouts.app')
@section('content')
    <div class="w-390 mt-4 mb-4">
    <h1 class="font-semibold text-3xl text-center py-5 text-[#3A384C]">Archives</h1>
    <a href="{{ route('dashboard') }}" class="bg-[#A93232] text-end py-2 px-4 text-[#feffea] rounded-xl mb-2">back</a>
    </div>
    <div class="bg-[#DE6262] w-300 flex flex-col max-w-full overflow-x-auto px-3 justify-center rounded-4xl shadow-md mt-3 mb-6 md:w-350">
        <div class="py-4" >@include('tables.donationarchives')</div>
    </div>
@endsection