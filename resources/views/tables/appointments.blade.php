    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md w-full">
        <thead>
            <tr>
                @foreach(['DONOR', 'HOSPITAL', 'SOURCE ID', 'STATUS', 'CREATED AT', 'VIEW'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2 text-[#3A384C] font-bold text-center">{{ $heads }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{-- Use forelse to show a message if no data exists --}}
            @forelse($appointments as $appointment)
            <tr class="hover:bg-slate-50 transition-colors">
                
                {{-- Safe access to user names --}}
                <td class="border-black-200 border border-slate-300 px-4 py-2">
                    {{ $appointment->user?->first_name ?? 'Unknown' }} {{ $appointment->user?->last_name ?? 'User' }}
                </td>

                {{-- Safe access to hospital name --}}
                <td class="border-black-200 border border-slate-300 px-4 py-2">
                    {{ $appointment->hospital?->hospital_name ?? 'Unassigned Hospital' }}
                </td>
                
                {{-- Unified Source ID Column --}}
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center font-mono">
                    @if($appointment->donation_id)
                        D - {{ $appointment->donation_id }}
                    @elseif($appointment->request_id)
                        R - {{ $appointment->request_id }}
                    @else
                        <span class="text-gray-400">N/A</span>
                    @endif
                </td>

                {{-- Status with Dynamic Coloring --}}
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center">
                    <span class="{{ $appointment->status == 'Completed' ? 'text-green-600' : ($appointment->status == 'Cancelled' ? 'text-red-600' : 'text-blue-600') }}">
                        {{ $appointment->status }}
                    </span>
                </td>
                
                {{-- Formatted Date --}}
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-sm text-center">
                    {{ $appointment->created_at?->format('M d, Y') ?? 'N/A' }}
                </td>
                
                {{-- View Link --}}
                <td class="border-black-200 border border-slate-300 px-7 py-2 text-center">
                    <a href="{{ route('appointment.edit', $appointment->appointment_id) }}" class="underline text-[#0000ff] hover:text-[#00008b]">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="border border-slate-300 px-4 py-10 text-center text-gray-500 italic bg-white">
                    No appointments found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $appointments->appends(request()->query())->links() }}
    </div>