@extends('shared.layout')
@section('title', 'Detail Skripsi')
@section('content')
<div class="container mt-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('thesis.index') }}"> Skripsi </a></li>
            <li class="breadcrumb-item active"> Detail Skripsi </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <i class="fa fa-pencil"></i>
            Sunting Skripsi
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('thesis.update', $thesis) }}">
                @csrf
                <div class='form-group'>
                    <label for='title'> Judul: </label>
                    <input
                        placeholder="Judul skripsi"
                        id='title' name='title' type='text'
                        value='{{ old('title', $thesis->title) }}'
                        class='form-control {{ !$errors->has('title') ?: 'is-invalid' }}'>
                
                    <div class='invalid-feedback'>
                        {{ $errors->first('title') }}
                    </div>
                </div>

                <div class='form-group'>
                    <label for='abstract'> Abstrak: </label>
                
                    <textarea
                        placeholder="Teks abstrak skripsi"
                        id='abstract' name='abstract'
                        class='form-control {{ !$errors->has('abstract') ?: 'is-invalid' }}'
                        col='30' row='6'
                        >{{ old('abstract', $thesis->abstract) }}</textarea>
                
                    <div class='invalid-feedback'>
                        {{ $errors->first('abstract') }}
                    </div>
                </div>

                <div class='form-group'>
                    <label for='chapter_1'> Bab I: </label>
                
                    <textarea
                        placeholder="Teks isi bab I"
                        id='chapter_1' name='chapter_1'
                        class='form-control {{ !$errors->has('chapter_1') ?: 'is-invalid' }}'
                        col='30' row='6'
                        >{{ old('chapter_1', $thesis->chapter_1) }}</textarea>
                
                    <div class='invalid-feedback'>
                        {{ $errors->first('chapter_1') }}
                    </div>
                </div>

                <div class='form-group'>
                    <label for='chapter_2'> Bab II: </label>
                
                    <textarea
                        placeholder="Teks isi bab II"
                        id='chapter_2' name='chapter_2'
                        class='form-control {{ !$errors->has('chapter_2') ?: 'is-invalid' }}'
                        col='30' row='6'
                        >{{ old('chapter_2', $thesis->chapter_2) }}</textarea>
                
                    <div class='invalid-feedback'>
                        {{ $errors->first('chapter_2') }}
                    </div>
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-primary">
                        Perbarui
                        <i class="fa fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection