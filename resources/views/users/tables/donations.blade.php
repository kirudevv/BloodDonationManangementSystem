    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md">
        <thead>
            <tr>
                @foreach(['Donation ID', 'Donation Date', 'Hospital', 'Status', 'Edit', 'Archive', 'Delete'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2">{{ $heads }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($donacion as $donation)
            <tr>
                @foreach([$donation->donation_id, $donation->donation_date, $donation->hospital->hospital_name, $donation->status] as $data)
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $data }}</td>
                @endforeach
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-[#0000ff] text-decoration: underline"><a href="{{ route('donation.edit', $donation->donation_id)}}">Edit</a></td>
                <td class="border-black-200 border border-slate-300 px-7 py-3 text-decoration: underline text-[#0000ff]">
                    <form action="{{ route('donation.archive', $donation->donation_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-[#D4AF70] text-[#FEFFEA] rounded hover:bg-[#C9A961] transition duration-300 text-sm">Archive</button>
                    </form>
                </td>
                 <td class="border-black-200 border border-slate-300 px-7 py-3 text-decoration: underline text-[#0000ff]">
                    <form action="{{ route('donation.delete', $donation->donation_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-[#DE6262] text-[#FEFFEA] rounded hover:bg-[#A93232] transition duration-300 text-sm">Delete</button>
                    </form>
                </td>
            @endforeach
            </tr>
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $donacion->appends(request()->query())->links(); }}
    </div>