@extends('shared.layout')
@section('title', 'Perbandingan Tingkat Similaritas')
@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('thesis.index')  }}"> Skripsi </a></li>
            <li class="breadcrumb-item"><a href="{{ route('thesis.detail', $thesis) }}"> Skripsi {{ $thesis->id }} </a></li>
            <li class="breadcrumb-item active" aria-current="page"> Perbandingan Similaritas </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <i class="fa fa-list"></i>
            Hasil Perbandingan dengan Skripsi-Skripsi Lainnya
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th> # </th>
                        <th> Judul </th>
                        <th> N. Similaritas Judul </th>
                        <th> N. Similaritas Abstrak </th>
                        <th> N. Similaritas Bab 1 </th>
                        <th> N. Similaritas Bab 2 </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($similarities as $similarity)
                    <tr>
                        <td> {{ $loop->iteration }}. </td>
                        <td> {{ $other_theses->get($similarity['id'])->title }} </td>
                        <td> {{ $similarity['title'] }}% </td>
                        <td> {{ $similarity['abstract'] }}% </td>
                        <td> {{ $similarity['chapter_1'] }}% </td>
                        <td> {{ $similarity['chapter_2'] }}% </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection