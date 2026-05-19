@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-[#3A384C] mb-6">Inventory Archives / History</h1>

        <div class="mb-6">
            <a href="{{ route('dashboard') }}"
                class="bg-[#3A384C] text-white px-6 py-2 rounded-lg hover:bg-[#2A283C] transition duration-300">
                Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-lg font-bold text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

            <table class="w-full border-collapse bg-[#feffea] min-w-full">
                <thead class="bg-[#A93232] text-white">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold">DONATION ID</th>
                        <th class="px-4 py-3 text-center font-bold">BLOOD TYPE</th>
                        <th class="px-4 py-3 text-center font-bold">COMPONENT</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="px-4 py-3 text-center font-bold">HOSPITAL</th>
                        @endif
                        <th class="px-4 py-3 text-center font-bold">EXPIRY</th>
                        <th class="px-4 py-3 text-center font-bold">STATUS</th>
                        <th class="px-4 py-3 text-center font-bold">ARCHIVED AT</th>
                        <th class="px-4 py-3 text-center font-bold">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($archived as $item)
                        <tr class="hover:bg-slate-50 transition-colors text-[#3A384C] border-b border-slate-200">
                            <td class="px-4 py-4 text-center font-mono">D - {{ $item->donation_id }}</td>
                            <td class="px-4 py-4 text-center font-bold text-lg text-red-600">
                                {{ $item->blood_type }}</td>
                            <td class="px-4 py-4 text-center">{{ $item->blood_components }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td class="px-4 py-4 text-center text-sm">
                                    {{ $item->donation->hospital->hospital_name ?? 'N/A' }}</td>
                            @endif
                            <td class="px-4 py-4 text-center text-sm">
                                {{ \Carbon\Carbon::parse($item->expiry_date)->format('M d, Y') }}</td>
                            <td class="px-4 py-4 text-center">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold {{ $item->status == 'Granted' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center text-sm text-gray-500">
                                {{ $item->deleted_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('inventory.restore', $item->inventory_id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-600 text-white px-4 py-1 rounded-lg text-xs font-bold hover:bg-green-700 transition duration-300">
                                        RESTORE
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 8 : 7 }}"
                                class="px-4 py-12 text-center text-gray-500 italic">
                                No archived inventory records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 px-4">
                {{ $archived->appends(request()->query())->links() }}
            </div>
    </div>
@endsection