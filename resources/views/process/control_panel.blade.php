@extends('shared.layout')

@section('title', 'Document Similarity | Control Panel')

@section('content')
<div class="container mt-5">
    <h1>
        Penghitung Similaritas Pasangan Dokumen
    </h1>

    <div id="root-process-text">
        <ProcessText/>
    </div>

</div>
@endsection