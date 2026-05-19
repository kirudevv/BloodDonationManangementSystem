    <table class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md w-full">
        <thead>
            <tr>
                @foreach(['Req ID', 'Hospital', 'Blood Type', 'Units', 'Status', 'View', 'Delete'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2">{{ $heads }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($bloodrequests->where('user_id', Auth::id()) as $requests)
            <tr>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $requests->request_id }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $requests->hospital->hospital_name }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $requests->blood_type }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $requests->units }}</td>
                <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $requests->status }}</td>
                <td class="border-black-200 border border-slate-300 px-7 py-2 text-decoration: underline text-[#0000ff]"><a href="{{ route('bloodrequest.edit', $requests->request_id) }}">View</a></td>
                <td class="border-black-200 border border-slate-300 px-7 py-3 text-decoration: underline text-[#0000ff]">
                    <form action="{{ route('bloodrequest.delete', $requests->request_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-[#DE6262] text-[#FEFFEA] rounded hover:bg-[#A93232] transition duration-300 text-sm">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mt-4 px-4">
        {{ $bloodrequests->appends(request()->query())->links() }}
    </div>