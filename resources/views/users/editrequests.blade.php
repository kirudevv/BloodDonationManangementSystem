@extends('layouts.app')
@section('content')
    <div class="w-100 mt-4 mb-4 md:w-120">
    <h1 class="font-semibold text-3xl text-center py-5 text-[#3A384C]">Edit Requests</h1>
    <a href="{{ route('dashboard') }}" class="bg-[#A93232] text-end py-2 px-4 text-[#feffea] rounded-xl mb-2">back</a>
    </div>
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
        <form action="{{ route('bloodrequest.update', $bloodrequest->request_id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('layouts.requesteditform')
    </form>
@endsection
