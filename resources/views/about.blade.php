<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @extends('layouts.app')
    @section('base')
    @section('content')
        <p>Hi i am jon roy</p>
        <p>and i am a student</p>
    @endsection
    @endsection
</body>
</html>
