    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md w-100">
        <thead>
            <tr>
                @foreach(['Hospital ID', 'Hospital Name', 'Address', 'Contact Person', 'Phone Number', 'Hospital Email', 'Edit'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2 text-[#3A384C] font-bold text-center">{{ $heads }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($hospitals as $hospital)
            <tr>
                @foreach([$hospital->hospital_id, $hospital->hospital_name, $hospital->address, $hospital->contact_person, $hospital->phone_number, $hospital->hospital_email] as $data)
                <td class="border-black-200 border border-slate-300 px-4 py-2 text-center">{{ $data }}</td>
                @endforeach
                <td class="border-black-200 border border-slate-300 px-7 py-2 text-decoration: underline text-[#0000ff]"><a href="{{ route('hospital.edit', $hospital->hospital_id) }}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $hospitals->appends(request()->query())->links(); }}
    </div>