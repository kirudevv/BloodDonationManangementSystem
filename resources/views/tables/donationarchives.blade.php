    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] rounded-3xl px-4 py-2 overflow-hidden shadow-sm min-w-full">
        <thead>
            <tr>
                @foreach(['USER', 'DONATION ID', 'BLOOD TYPE', 'BLOOD COMPONENT', 'UNITS DONATED', 'HEMOGLOBIN LEVEL', 'DONATION DATE', 'GENDER', 'WEIGHT (KG)', 'LAST DONATION DATE', 'MEDICAL CONDITION', 'HOSPITAL', 'RESTORE'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2 text-[#3A384C] font-bold text-center">{{ $heads }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($archived as $donation)
            <tr>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->user->full_name }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->donation_id }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2 font-bold text-red-600">{{ $donation->blood_type }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->blood_components }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->units_donated }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->hemoglobin_level }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->donation_date }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->gender }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->weight_kg }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->last_donation_date }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $donation->medical_condition }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-sm">{{ $donation->hospital->hospital_name }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center">
                    <form action="{{ route('donation.restore', $donation->donation_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-bold hover:bg-green-700 transition duration-300">
                            RESTORE
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $archived->appends(request()->query())->links() }}
    </div>