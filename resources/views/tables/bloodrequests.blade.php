@if(session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-lg font-bold text-green-800">{{ session('success') }}</p>
        </div>
    </div>
@endif

    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md w-100">
        <thead>
            <tr>
                @foreach(['BLOOD TYPE', 'BLOOD COMPONENTS', 'UNITS', 'GENDER', 'URGENCY', 'ATTENDING PHYSICIAN', 'ADDRESS', 'HOSPITAL', 'EDIT', 'ARCHIVE', 'DELETE'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2">{{ $heads }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($bloodrequests as $requests)
            <tr>
                @foreach([$requests->blood_type, $requests->blood_components, $requests->units, $requests->gender, $requests->urgency, $requests->attending_physician, $requests->address, $requests->hospital->hospital_name] as $data)
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $data }}</td>
                @endforeach
                <td class="border-black-200 border border-slate-300 px-7 py-2 text-decoration: underline text-[#0000ff]"><a href="{{ route('bloodrequest.edit', $requests->request_id) }}">View</a></td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">
                    <form action="{{ route('bloodrequest.archive', $requests->request_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-[#D4AF70] text-[#FEFFEA] rounded hover:bg-[#C9A961] transition duration-300 text-sm">Archive</button>
                    </form>
                </td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">
                    <form action="{{ route('bloodrequest.delete', $requests->request_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-[#DE6262] text-[#FEFFEA] rounded hover:bg-[#A93232] transition duration-300 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $bloodrequests->appends(request()->query())->links() }}
    </div>