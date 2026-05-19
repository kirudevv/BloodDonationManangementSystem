<nav class="bg-[#DE6262] flex justify-between items-start h-16 px-4 md:px-8 fixed top-0 left-0 w-full z-50 shadow-md">
    
    {{-- Logo Container --}}
    <div class="flex items-center h-full">
        <img src="{{ asset('images/logo1.png') }}" alt="logo" class="h-8">
    </div>

    {{-- NAVIGATION LINKS --}}
    <ul class="nav-links flex items-start h-full space-x-6 sm:space-x-12 md:space-x-16">
        
        <li class="h-full flex items-center transition duration-300 {{request()->is('/') ? 'bg-[#FEFFEA] text-[#3A384C] rounded-b-3xl px-4 md:px-6' : 'text-[#FEFFEA] hover:text-[#3A384C]'}}">
            <a href="/">
                <span class="md:hidden"><i class="fa-solid fa-house text-xl"></i></span> {{-- Mobile --}}
                <span class="hidden md:inline">Home</span> {{-- Desktop --}}
            </a>
        </li>

        <li class="h-full flex items-center transition duration-300 {{request()->is('about') ? 'bg-[#FEFFEA] text-[#3A384C] rounded-b-3xl px-4 md:px-6' : 'text-[#FEFFEA] hover:text-[#3A384C]'}}">
            <a href="/about">
                <span class="md:hidden"><i class="fa-solid fa-circle-info text-xl"></i></span>
                <span class="hidden md:inline">About</span>
            </a>
        </li>

        <li class="h-full flex items-center transition duration-300 {{request()->is('blood-banks') ? 'bg-[#FEFFEA] text-[#3A384C] rounded-b-3xl px-4 md:px-6' : 'text-[#FEFFEA] hover:text-[#3A384C]'}}">
            <a href="/blood-banks">
                <span class="md:hidden"><i class="fa-solid fa-droplet text-xl"></i></span>
                <span class="hidden md:inline">Blood Banks</span>
            </a>
        </li>

        {{-- Divider line (Hidden on super small screens so things don't crowd) --}}
        <li class="h-full hidden xs:flex items-center text-[#FEFFEA] font-semibold text-xl">|</li>

        <li class="h-full flex items-center transition duration-300 {{request()->is('dashboard') ? 'bg-[#FEFFEA] text-[#3A384C] rounded-b-3xl px-4 md:px-6' : 'text-[#FEFFEA] hover:text-[#3A384C]' }}">
            @auth
                <a href="{{ route('dashboard') }}">
                    <span class="md:hidden"><i class="fa-solid fa-user-gear text-xl"></i></span>
                    <span class="hidden md:inline">{{ Auth::user()->first_name }}</span>
                </a>
            @endauth

            @guest
                <a href="{{ route('login') }}">
                    <span class="md:hidden"><i class="fa-solid fa-user text-xl"></i></span>
                    <span class="hidden md:inline">Account</span>
                </a>
            @endguest
        </li>
    </ul>
</nav>