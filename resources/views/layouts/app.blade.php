<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Sweat & Cheers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- Added overflow-x-hidden to protect the background scaling --}}
<body class="overflow-x-hidden">
    <div class="min-h-screen flex flex-col bg-cover bg-center bg-no-repeat bg-fixed w-full h-full" style="background-image: url('{{asset('images/bg-web.png')}}');">
        @yield('base')
        @include('nav')

        {{-- Added px-4 only for mobile so content doesn't touch the screen edge --}}
        <main class="flex flex-col items-center justify-center pt-20 px-4 md:px-0">
            @yield('content')
        </main>

        @include('footer')
    </div>
</body>
</html>