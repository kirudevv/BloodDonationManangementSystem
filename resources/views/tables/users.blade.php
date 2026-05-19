@if(session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center">
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

<table
    class="border-black-400 border-collapse border border-slate-200 bg-[#feffea] overflow-hidden rounded-3xl shadow-md w-full">
    <thead>
        <tr>
            @foreach(['User ID', 'Full Name', 'Gender', 'Date of Birth', 'Email', 'Contact Info', 'Role', 'Status', 'Edit'] as $heads)
                <th class="border-black-200 border border-slate-300 px-4 py-2">{{ $heads }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                @foreach([$user->user_id, $user->full_name, $user->gender, $user->date_of_birth, $user->email, $user->contact_info, $user->role, $user->status] as $data)
                    <td class="border-black-200 border border-slate-300 px-4 py-2">{{ $data }}</td>
                @endforeach
                <td class="border-black-200 border border-slate-300 px-7 py-2 text-decoration: underline text-[#0000ff]"><a
                        href="{{ route('user.edit', $user->user_id) }}">View</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4 px-4">
    {{ $users->appends(request()->query())->links() }}
</div>
<div>

</div>