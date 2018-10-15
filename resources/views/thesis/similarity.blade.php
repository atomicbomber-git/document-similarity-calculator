@extends('shared.layout')
@section('title', 'Perbandingan Tingkat Similaritas')
@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('thesis.index')  }}"> Skripsi </a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('thesis.detail', $thesis) }}">
                    Detail Skripsi <strong> '{{ $thesis->title }}' </strong>
                </a>
            </li>
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
                        <th style="width: 18rem"> Judul </th>
                        <th> N. Similaritas Judul </th>
                        <th> N. Similaritas Abstrak </th>
                        <th> N. Similaritas Bab 1 </th>
                        <th> N. Similaritas Bab 2 </th>
                        <th> N. Similaritas Bab 5 </th>
                        <th> Rata-Rata N. Similaritas </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($similarities as $similarity)
                    <tr>
                        <td> {{ $loop->iteration }}. </td>
                        <td>
                            <a href="{{ route('thesis.detail', $thesis) }}">
                                {{ $other_theses->get($similarity['id'])->title }}
                            </a>
                        </td>
                        <td class="{{ $similarity['title'] >= 40 ? 'table-danger' : '' }}">
                            {{ $similarity['title'] }}%
                        </td>
                        <td class="{{ $similarity['abstract'] >= 40 ? 'table-danger' : '' }}">
                            {{ $similarity['abstract'] }}%
                        </td>
                        <td class="{{ $similarity['chapter_1'] >= 40 ? 'table-danger' : '' }}">
                            {{ $similarity['chapter_1'] }}%
                        </td>
                        <td class="{{ $similarity['chapter_2'] >= 40 ? 'table-danger' : '' }}">
                            {{ $similarity['chapter_2'] }}%
                        </td>
                        <td class="{{ $similarity['chapter_5'] >= 40 ? 'table-danger' : '' }}">
                            {{ $similarity['chapter_5'] }}%
                        </td>
                        <td class="{{ $similarity['average'] >= 40 ? 'table-danger' : '' }}">
                            {{ $similarity['average'] }}%
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection