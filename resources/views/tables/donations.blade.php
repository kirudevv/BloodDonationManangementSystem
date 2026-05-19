@if(session('success'))
    <div class="w-200 mt-6 mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-lg font-bold text-green-800">
                {{ session('success') }}
            </p>
        </div>
    </div>
@endif
<table
    class="border-black-200 border-collapse border border-slate-400 bg-[#FEFFEA] rounded-3xl overflow-hidden shadow-md w-100">
    <thead>
        <tr>
            @foreach(['USER', 'DONATION ID', 'BLOOD TYPE', 'BLOOD COMPONENT', 'UNITS DONATED', 'HEMOGLOBIN LEVEL', 'DONATION DATE', 'GENDER', 'WEIGHT (KG)', 'LAST DONATION DATE', 'MEDICAL CONDITION', 'HOSPITAL', 'STATUS', 'EDIT', 'ARCHIVE', 'DELETE'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2">{{ $heads }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($donations as $donation)
            <tr>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->user->full_name }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->donation_id }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->blood_type }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->blood_components }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->units_donated }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->hemoglobin_level }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->donation_date }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->gender }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->weight_kg }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->last_donation_date }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->medical_condition }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->hospital->hospital_name }}</td>
                <td
                    class="border-black-200 border border-slate-300 px-4 py-2 {{ $donation->status->value == 'Screening' ? 'text-yellow-600' : ($donation->status->value == 'Approved' ? 'text-green-600' : 'text-red-600') }}">
                    {{ $donation->status }}</td>
                <td class="border-black-200 border border-slate-300 px-7 py-3 text-decoration: underline text-[#0000ff]"><a
                        href="{{ route('donation.edit', $donation->donation_id) }}">View</a></td>
                <td class="border-black-200 border border-slate-300 px-7 py-3 text-decoration: underline text-[#0000ff]">
                    <form action="{{ route('donation.archive', $donation->donation_id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 bg-[#D4AF70] text-[#FEFFEA] rounded hover:bg-[#C9A961] transition duration-300 text-sm">Archive</button>
                    </form>
                </td>
                <td class="border-black-200 border border-slate-300 px-7 py-3 text-decoration: underline text-[#0000ff]">
                    <form action="{{ route('donation.delete', $donation->donation_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 bg-[#DE6262] text-[#FEFFEA] rounded hover:bg-[#A93232] transition duration-300 text-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4 px-4">
    {{ $donations->appends(request()->query())->links() }}
</div>