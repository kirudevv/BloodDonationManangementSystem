<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Sweat and Cheers | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @extends('layouts.app')
    @section('base')
    @section('content')
        <h1 class="font-semibold text-3xl py-5 text-[#3A384C] mt-25 items-center">Login</h1>

            <div class="bg-[#FEFFEA] w-95 flex flex-col rounded-xl px-5 px-4 shadow-sm items-center justify-center md:w-120">
                @if(session('success'))
                    <div class="w-200 mt-6 mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 shadow-md flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-lg font-bold text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-4 w-full max-w-md py-4 items-center justify-center">
                    @csrf

                    <div>
                        <label for="email" class="text-[#3A384C] font-semibold mb-1 text-sm">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="yourname@email.com" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error ('email') border-red-600 @enderror">
                    </div>

                    <div>
                        <label for="password" class="text-[#3A384C] font-semibold mb-1 text-sm">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required class="w-full px-4 py-2 rounded-lg border-2 border-slate-200 bg-[#E6E6E6] focus:border-[#3A384C] focus:outline-none transition duration-300 @error ('password') border-red-600 @enderror">
                    </div>


                    <div class="py-3">
                        <button type="submit" class="w-full py-3 padding-100 bg-[#A93232] text-2xl text-[#FEFFEA] font-semibold rounded-lg hover:bg-[#DE6262] transition duration-300">Login</button>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-600 p-3 rounded-lg text-sm">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center">
                        <a href="{{ route('registration.create') }}" class="text-sm text-[#3A384C]items-center justify-center">Dont have an account? create here!</a>
                    </div>

                </form>
            </div>
    @endsection
    @endsection
</body>
</html>