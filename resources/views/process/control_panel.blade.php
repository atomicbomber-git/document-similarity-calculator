<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Document Similarity | Control Panel </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1>
            Panel Kendali Utama
        </h1>
        <p class="lead"> Penghitung Similaritas Dokumen dengan Teknik <em> Cosine Similarity </em> </p>

        <div id="root-process-text">
            <ProcessText/>
        </div>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>