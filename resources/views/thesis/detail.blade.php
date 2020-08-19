@extends('shared.layout')
@section('title', 'Detail Skripsi')
@section('content')
<div class="container mt-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('thesis.index') }}"> Skripsi </a></li>
            <li class="breadcrumb-item active">
                Detail Skripsi <strong> '{{ $thesis->title }}' </strong>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil"></i>
                    Sunting Skripsi
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('thesis.update', $thesis) }}">
                        @csrf

                        <div class='form-group'>
                            <label for='student_name'> Nama Mahasiswa: </label>

                            <input
                                id='student_name' name='student_name' type='text'
                                value='{{ old('student_name', $thesis->student_name) }}'
                                class='form-control {{ !$errors->has('student_name') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('student_name') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='student_id'> NIM: </label>

                            <input
                                id='student_id' name='student_id' type='text'
                                value='{{ old('student_id', $thesis->student_id) }}'
                                class='form-control {{ !$errors->has('student_id') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('student_id') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='study_program'> Program Studi: </label>

                            <input
                                id='study_program' name='study_program' type='text'
                                value='{{ old('study_program', $thesis->study_program) }}'
                                class='form-control {{ !$errors->has('study_program') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('study_program') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='seminar_date'> Tanggal Sidang: </label>

                            <input
                                id='seminar_date' name='seminar_date' type='date'
                                value='{{ old('seminar_date', $thesis->seminar_date) }}'
                                class='form-control {{ !$errors->has('seminar_date') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('seminar_date') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='advisor_1_id'> NIP Pembimbing I: </label>

                            <input
                                id='advisor_1_id' name='advisor_1_id' type='text'
                                value='{{ old('advisor_1_id', $thesis->advisor_1_id) }}'
                                class='form-control {{ !$errors->has('advisor_1_id') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('advisor_1_id') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='advisor_1_name'> Pembimbing I: </label>

                            <input
                                id='advisor_1_name' name='advisor_1_name' type='text'
                                value='{{ old('advisor_1_name', $thesis->advisor_1_name) }}'
                                class='form-control {{ !$errors->has('advisor_1_name') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('advisor_1_name') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='advisor_2_id'> NIP Pembimbing II: </label>

                            <input
                                id='advisor_2_id' name='advisor_2_id' type='text'
                                value='{{ old('advisor_2_id', $thesis->advisor_2_id) }}'
                                class='form-control {{ !$errors->has('advisor_2_id') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('advisor_2_id') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='advisor_2_name'> Pembimbing II: </label>

                            <input
                                id='advisor_2_name' name='advisor_2_name' type='text'
                                value='{{ old('advisor_2_name', $thesis->advisor_2_name) }}'
                                class='form-control {{ !$errors->has('advisor_2_name') ?: 'is-invalid' }}'>

                            <div class='invalid-feedback'>
                                {{ $errors->first('advisor_2_name') }}
                            </div>
                        </div>

                        <hr>

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
                                col='30' row='6' style="height: 18rem"
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
                                col='30' row='6' style="height: 18rem"
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
                                col='30' row='6' style="height: 18rem"
                                >{{ old('chapter_2', $thesis->chapter_2) }}</textarea>

                            <div class='invalid-feedback'>
                                {{ $errors->first('chapter_2') }}
                            </div>
                        </div>

                        <div class='form-group'>
                            <label for='chapter_5'> Bab V: </label>

                            <textarea
                                placeholder="Teks isi bab V"
                                id='chapter_5' name='chapter_5'
                                class='form-control {{ !$errors->has('chapter_5') ?: 'is-invalid' }}'
                                col='30' row='6' style="height: 18rem"
                                >{{ old('chapter_5', $thesis->chapter_5) }}</textarea>

                            <div class='invalid-feedback'>
                                {{ $errors->first('chapter_5') }}
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

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-calculator"></i>
                    Hitung Nilai Similaritas dengan Skripsi-Skripsi Lainnya
                </div>
                <div class="card-body">
                    <a href="{{ route('thesis.compare', $thesis) }}" class="btn mb-2 d-block btn-primary">
                        Bandingkan dengan Skripsi-Skripsi Lainnya
                    </a>

                    <a href="{{ route('thesis.summary', $thesis) }}" class="btn mb-2 d-block btn-primary">
                        Summary Similaritas Skripsi / Tugas Akhir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
