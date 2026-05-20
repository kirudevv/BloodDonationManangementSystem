    @extends('layouts.app') 
    @section('content')
        <div class="bg-[#A93232] px-10 py-3 rounded-lg mb-2 md:px-20 md:md-3">
            <label for="actionType" class="text-[#FEFFEA] items-start justify-start font-semibold">Choose an action</label>
            <select id="actionType" name="actionType" onchange="toggle()" class="bg-[#FEFFEA] rounded-lg border-2 focus:border-[#3A384C] border-slate-200 focus:outline-none transition duration-300">
                <option value="" disabled selected>Click here to choose</option>
                <option value="donate" selected>Donate Blood</option>
                <option value="request">Request Blood</option>
            </select>
        </div>
        

        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border: 1px solid #f87171; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('donation.store') }}" method="POST">
                @csrf
                
                <div id="donate" class="hidden">
                    @include('layouts.donation')
                </div>    
                
                    
            </form>

            <form action="{{ route('request.store') }}" method="POST">
                @csrf
                <div id="request" class="hidden">
                    @include('layouts.requests')
                </div>

                
            </form>


            <script>
                function toggle() {
                    const select = document.getElementById('actionType').value;
                    const donation = document.getElementById('donate');
                    const requests = document.getElementById('request');

                    donation.classList.add('hidden');
                    requests.classList.add('hidden');

                    if(select === 'donate'){
                        donation.classList.remove('hidden');
                    } else if (select === 'request'){
                        requests.classList.remove('hidden');
                    }
                }; 
                document.addEventListener('DOMContentLoaded', function(){
                    toggle();
                });
            </script>
    @endsection