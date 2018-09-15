@extends('shared.layout')

@section('title', 'Document Similarity | Control Panel')

@section('content')
<div class="container mt-5">
    <h1>
        Panel Kendali Utama
    </h1>
    <p class="lead"> Penghitung Similaritas Dokumen dengan Teknik <em> Cosine Similarity </em> </p>

    <div id="root-process-text">
        <ProcessText/>
    </div>

</div>
@endsection