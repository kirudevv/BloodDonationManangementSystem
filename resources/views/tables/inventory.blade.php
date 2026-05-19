{{-- Grant Modal (one per inventory item, hidden by default) --}}
@if(in_array(auth()->user()->role, ['admin', 'staff', 'hospital_staff']))
    @foreach($inventory as $item)
        @if($item->status == 'Available')
        {{-- Find matching pending blood requests --}}
        @php
            $donationHospitalId = $item->donation->hospital_id ?? null;
            $matchingRequests = $bloodrequests->filter(function($r) use ($item, $donationHospitalId) {
                return strtolower(trim($r->blood_type)) === strtolower(trim($item->blood_type))
                    && $r->blood_components === $item->blood_components
                    && ($r->status ?? 'Pending') !== 'Approved'
                    && ($donationHospitalId === null || $r->hospital_id == $donationHospitalId);
            });
        @endphp

        <div id="grant-modal-{{ $item->inventory_id }}"
             class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-[#FEFFEA] rounded-2xl shadow-2xl w-full max-w-3xl mx-4 overflow-hidden">
                {{-- Modal Header --}}
                <div class="bg-[#A93232] px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">Grant Blood Unit</h2>
                        <p class="text-sm text-red-200 mt-0.5">
                            Inventory #D-{{ $item->donation_id }} &mdash;
                            <span class="font-semibold">{{ $item->blood_type }}</span> /
                            {{ $item->blood_components }}
                        </p>
                    </div>
                    <button onclick="document.getElementById('grant-modal-{{ $item->inventory_id }}').classList.add('hidden')"
                            class="text-white text-2xl leading-none hover:text-red-200 transition">&times;</button>
                </div>

                {{-- Modal Body --}}
                <div class="px-6 py-5">
                    @if($matchingRequests->isEmpty())
                        <p class="text-center text-gray-500 italic py-6">
                            No pending blood requests match this unit's blood type &amp; component.
                        </p>
                    @else
                        <p class="text-sm text-[#3A384C] mb-3 font-medium">
                            Select the request to fulfil with this blood unit:
                        </p>
                        <div class="overflow-x-auto rounded-xl border border-slate-200">
                            <table class="w-full text-sm text-[#3A384C]">
                                <thead class="bg-[#DE6262] text-white">
                                    <tr>
                                        @foreach(['Req ID', 'Requester', 'Blood Type', 'Component', 'Units', 'Urgency', 'Hospital', 'Grant'] as $h)
                                        <th class="px-4 py-2 text-center font-semibold">{{ $h }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matchingRequests as $req)
                                    <tr class="border-t border-slate-200 hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-2 text-center font-mono">R-{{ $req->request_id }}</td>
                                        <td class="px-4 py-2 text-center">{{ $req->user?->first_name }} {{ $req->user?->last_name }}</td>
                                        <td class="px-4 py-2 text-center font-bold">{{ $req->blood_type }}</td>
                                        <td class="px-4 py-2 text-center">{{ $req->blood_components }}</td>
                                        <td class="px-4 py-2 text-center">{{ $req->units }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <span class="
                                                @if($req->urgency === 'Emergency') text-red-600 font-bold
                                                @elseif($req->urgency === 'Urgent') text-orange-500 font-semibold
                                                @else text-green-600 @endif
                                            ">{{ $req->urgency }}</span>
                                        </td>
                                        <td class="px-4 py-2 text-center text-xs">{{ $req->hospital?->hospital_name }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <form action="{{ route('inventory.grant', $req->request_id) }}" method="POST"
                                                  onsubmit="return confirm('Grant this blood unit to request R-{{ $req->request_id }}?')">
                                                @csrf
                                                <input type="hidden" name="inventory_id" value="{{ $item->inventory_id }}">
                                                <button type="submit"
                                                        class="bg-[#A93232] text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-[#DE6262] transition duration-300">
                                                    GRANT
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endif

    {{-- Inventory Table --}}
    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md w-full">
        <thead>
            <tr>
                @php 
                    $headers = ['DONATION ID', 'BLOOD TYPE', 'COMPONENT'];
                    if(auth()->user()->role === 'admin') { $headers[] = 'HOSPITAL'; }
                    $headers = array_merge($headers, ['EXPIRY', 'STATUS']);
                    if(in_array(auth()->user()->role, ['admin', 'staff', 'hospital_staff'])) { $headers[] = 'GRANT'; }
                @endphp

                @foreach($headers as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2 text-[#3A384C] font-bold text-center">
                    <div class="flex items-center justify-center gap-2">
                        {{ $heads }}
                        @if($heads === 'GRANT')
                             <a href="{{ route('inventory.archives') }}" title="View Archives" class="text-xs text-blue-600 underline font-normal hover:text-blue-800">Archives</a>
                        @endif
                    </div>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($inventory as $item)
            <tr class="hover:bg-slate-50 transition-colors text-[#3A384C]">
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center font-mono">
                    D - {{ $item->donation_id }}
                </td>

                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center font-bold">
                    {{ $item->blood_type }}
                </td>

                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center">
                    {{ $item->blood_components }}
                </td>

                {{-- Hospital Name only shows for Admin --}}
                @if(auth()->user()->role === 'admin')
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center text-sm">
                    {{ $item->donation->hospital->hospital_name ?? 'N/A' }}
                </td>
                @endif

                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center text-sm">
                    {{ \Carbon\Carbon::parse($item->expiry_date)->format('M d, Y') }}
                </td>

                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center">
                    <span class="{{ $item->status == 'Available' ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $item->status }}
                    </span>
                </td>

                @if(in_array(auth()->user()->role, ['admin', 'staff', 'hospital_staff']))
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center">
                    @if($item->status == 'Available')
                        <button onclick="document.getElementById('grant-modal-{{ $item->inventory_id }}').classList.remove('hidden')"
                                class="bg-[#DE6262] text-white px-3 py-1 rounded text-xs font-bold hover:bg-[#A93232] transition duration-300">
                            GRANT
                        </button>
                    @elseif($item->status == 'Reserved')
                        <form action="{{ route('inventory.destroy', $item->inventory_id) }}" method="POST" onsubmit="return confirm('Discard/Archive this reserved blood unit?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-500 text-white px-3 py-1 rounded text-xs font-bold hover:bg-gray-700 transition duration-300">
                                DISCARD
                            </button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs italic">N/A</span>
                    @endif
                </td>
                @endif
            </tr>
            @empty
            <tr>
                @php
                    $colspan = 5;
                    if(auth()->user()->role === 'admin') { $colspan++; }
                    if(in_array(auth()->user()->role, ['admin', 'staff', 'hospital_staff'])) { $colspan++; }
                @endphp
                <td colspan="{{ $colspan }}" class="border border-slate-300 px-4 py-10 text-center text-gray-500 italic bg-white">
                    No inventory records found for your facility.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $inventory->appends(request()->query())->links(); }}
    </div>