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

    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-list"></i>
            Hasil Perbandingan dengan Nilai Rata-Rata Similaritas Tertinggi
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
                    @foreach ($three_largest_averages as $similarity)
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

    <div class="card mb-5">
        <div class="card-header">
            <i class="fa fa-list"></i>
            Hasil Perbandingan dengan Nilai Similaritas Abstrak, Bab I, Bab II, dan Bab V Tertinggi
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th> Aspek </th>
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
                    <tr>
                        <td> Abstrak </td>
                        <td>
                            <a href="{{ route('thesis.detail', $thesis) }}">
                                {{ $other_theses->get($largest_abstract_s['id'])->title }}
                            </a>
                        </td>
                        <td class="{{ $largest_abstract_s['title'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_abstract_s['title'] }}%
                        </td>
                        <td class="{{ $largest_abstract_s['abstract'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_abstract_s['abstract'] }}%
                        </td>
                        <td class="{{ $largest_abstract_s['chapter_1'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_abstract_s['chapter_1'] }}%
                        </td>
                        <td class="{{ $largest_abstract_s['chapter_2'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_abstract_s['chapter_2'] }}%
                        </td>
                        <td class="{{ $largest_abstract_s['chapter_5'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_abstract_s['chapter_5'] }}%
                        </td>
                        <td class="{{ $largest_abstract_s['average'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_abstract_s['average'] }}%
                        </td>
                    </tr>

                    <tr>
                        <td> Bab I </td>
                        <td>
                            <a href="{{ route('thesis.detail', $thesis) }}">
                                {{ $other_theses->get($largest_chapter_1_s['id'])->title }}
                            </a>
                        </td>
                        <td class="{{ $largest_chapter_1_s['title'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_1_s['title'] }}%
                        </td>
                        <td class="{{ $largest_chapter_1_s['abstract'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_1_s['abstract'] }}%
                        </td>
                        <td class="{{ $largest_chapter_1_s['chapter_1'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_1_s['chapter_1'] }}%
                        </td>
                        <td class="{{ $largest_chapter_1_s['chapter_2'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_1_s['chapter_2'] }}%
                        </td>
                        <td class="{{ $largest_chapter_1_s['chapter_5'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_1_s['chapter_5'] }}%
                        </td>
                        <td class="{{ $largest_chapter_1_s['average'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_1_s['average'] }}%
                        </td>
                    </tr>

                    <tr>
                        <td> Bab II </td>
                        <td>
                            <a href="{{ route('thesis.detail', $thesis) }}">
                                {{ $other_theses->get($largest_chapter_2_s['id'])->title }}
                            </a>
                        </td>
                        <td class="{{ $largest_chapter_2_s['title'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_2_s['title'] }}%
                        </td>
                        <td class="{{ $largest_chapter_2_s['abstract'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_2_s['abstract'] }}%
                        </td>
                        <td class="{{ $largest_chapter_2_s['chapter_1'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_2_s['chapter_1'] }}%
                        </td>
                        <td class="{{ $largest_chapter_2_s['chapter_2'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_2_s['chapter_2'] }}%
                        </td>
                        <td class="{{ $largest_chapter_2_s['chapter_5'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_2_s['chapter_5'] }}%
                        </td>
                        <td class="{{ $largest_chapter_2_s['average'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_2_s['average'] }}%
                        </td>
                    </tr>

                    <tr>
                        <td> Bab V </td>
                        <td>
                            <a href="{{ route('thesis.detail', $thesis) }}">
                                {{ $other_theses->get($largest_chapter_5_s['id'])->title }}
                            </a>
                        </td>
                        <td class="{{ $largest_chapter_5_s['title'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_5_s['title'] }}%
                        </td>
                        <td class="{{ $largest_chapter_5_s['abstract'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_5_s['abstract'] }}%
                        </td>
                        <td class="{{ $largest_chapter_5_s['chapter_1'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_5_s['chapter_1'] }}%
                        </td>
                        <td class="{{ $largest_chapter_5_s['chapter_2'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_5_s['chapter_2'] }}%
                        </td>
                        <td class="{{ $largest_chapter_5_s['chapter_5'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_5_s['chapter_5'] }}%
                        </td>
                        <td class="{{ $largest_chapter_5_s['average'] >= 40 ? 'table-danger' : '' }}">
                            {{ $largest_chapter_5_s['average'] }}%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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