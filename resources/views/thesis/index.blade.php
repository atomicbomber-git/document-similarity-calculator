@extends('shared.layout')
@section('title', 'Seluruh Skripsi')
@section('content')
<div class="container mt-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> Skripsi </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <i class="fa fa-list"></i>
            Daftar Seluruh Skripsi
        </div>
        <div class="card-body">
            <div class="text-right my-2">
                <a href="{{ route('thesis.create') }}" class="btn btn-secondary btn-sm">
                    Tambahkan Skripsi Baru
                    <i class="fa fa-plus"></i>
                </a>
            </div>

            @include('shared.message')

            <table class="table table-striped table-sm mt-5">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Judul </th>
                        <th> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($theses as $thesis)
                    <tr>
                        <td> {{ $loop->iteration }}. </td>
                        <td> {{ $thesis->title }} </td>
                        <td>
                            <a href="{{ route('thesis.detail', $thesis) }}" class="btn btn-dark btn-sm">
                                Detail
                                <i class="fa fa-list-alt"></i>
                            </a>
                            <form action="{{ route('thesis.delete', $thesis) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $theses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection