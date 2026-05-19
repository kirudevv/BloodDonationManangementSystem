@extends('layouts.app')
@section('content')
    <div class="w-390 mt-4 mb-4">
    <h1 class="font-semibold text-3xl text-center py-5 text-[#3A384C]">Archives</h1>
    <a href="{{ route('dashboard') }}" class="bg-[#A93232] text-end py-2 px-4 text-[#feffea] rounded-xl mb-2">back</a>
    </div>
    @include('tables.donationarchives')
@endsection