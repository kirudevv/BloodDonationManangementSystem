<div class="bg-[#FEFFEA] w-120 flex flex-col px-6 py-6 items-start justify-start rounded-xl shadow-sm mb-3 mt-6">
    <form action="{{ route('appointments.update', $appointment->appointment_id) }}" method="POST" class="w-full">
        @csrf
        @method('PUT')

        {{-- User Name --}}
        <div class="w-full mb-4">
            <label class="text-[#3A384C] font-semibold mb-1 text-sm block">User</label>
            <input type="text" readonly value="{{ $appointment->user?->first_name }} {{ $appointment->user?->last_name }}" 
                class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 cursor-not-allowed">
        </div>

        {{-- Hospital Name --}}
        <div class="w-full mb-4">
            <label class="text-[#3A384C] font-semibold mb-1 text-sm block">Hospital</label>
            <input type="text" readonly value="{{ $appointment->hospital?->hospital_name }}" 
                class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 cursor-not-allowed">
        </div>

        {{-- Appointment Date (Logic to pull from Donation or Request) --}}
        <div class="w-full mb-4">
            <label class="text-[#3A384C] font-semibold mb-1 text-sm block">Appointment Date</label>
            @php
                $appDate = $appointment->donation_id 
                    ? $appointment->donation?->donation_date 
                    : $appointment->bloodRequest?->request_date;
            @endphp
            <input type="text" readonly value="{{ $appDate ? \Carbon\Carbon::parse($appDate)->format('M d, Y') : 'N/A' }}" 
                class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 cursor-not-allowed">
        </div>

        {{-- Status (The Touchable Field) --}}
        <div class="w-full mb-6">
            <label for="status" class="text-[#3A384C] font-semibold mb-1 text-sm block">Status</label>
            <select name="status" id="status" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300">
                @foreach(['Scheduled', 'Completed', 'No-show', 'Cancelled'] as $statusOption)
                    <option value="{{ $statusOption }}" {{ old('status', $appointment->status) == $statusOption ? 'selected' : '' }}>
                        {{ $statusOption }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full">
            <button type="submit" class="w-full py-3 bg-[#A93232] text-[#FEFFEA] rounded-lg hover:bg-[#DE6262] transition duration-300 shadow-md">
                Update Status
            </button>
        </div>
    </form>
</div>