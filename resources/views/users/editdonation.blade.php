@extends('layouts.app')
@section('content')
    <div class="w-120 mt-4 mb-4">
    <h1 class="font-semibold text-3xl text-center py-5 text-[#3A384C]">Edit Donation</h1>
    <a href="{{ route('dashboard') }}" class="bg-[#A93232] text-end py-2 px-4 text-[#feffea] rounded-xl mb-2">back</a>
    </div>

    @if(Auth::user()->role !== 'admin' && Auth::user()->role !== 'staff')
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
    <form action="{{ route('donation.update' , $donation->donation_id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('layouts.donationeditform')
    </form>
    @else
        @include('layouts.donationeditform')
    @endif

    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff' && $donation->status->value !== 'Screening')
    <div class="bg-[#FEFFEA] w-120 flex flex-col px-6 py-6 items-start justify-start rounded-xl shadow-sm mb-3 mt-6">
        <form action="{{ route('donation.updateStatus', $donation->donation_id) }}" method="POST" class="w-full">
            @csrf
            @method('PUT')
            <label for="status" class="text-[#3A384C] font-semibold mb-1 text-sm block">Approval Status</label>
            <select name="status" id="status" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
                @foreach(['Screening','Approved','Rejected'] as $statuses)
                    <option value="{{ $statuses }}" {{ old('status', $donation->status) == $statuses ? 'selected' : '' }}>
                        {{ $statuses }}
                    </option>                
                @endforeach
            </select>
            <div class="w-full mt-6">
                <button type="submit" class="w-full py-3 bg-[#A93232] text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 shadow-md">
                    Update Approval
                </button>
            </div>
        </form>
    </div>
    @endif
@endsection