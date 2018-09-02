<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Document Similarity Calculator </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Stemming dengan Sastrawi:
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('process.stem') }}">
                    @csrf
                    <div class="form-group">
                        <div class='form-group'>
                            <label for='raw_text'> Teks Mentah Bahasa Indonesia: </label>
                        
                            <textarea
                                id='raw_text' name='raw_text'
                                class='form-control {{ !$errors->has('raw_text') ?: 'is-invalid' }}'
                                col='30' row='6'
                                >{{ session('raw_text') }}</textarea>
                        
                            <div class='invalid-feedback'>
                                {{ $errors->first('raw_text') }}
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary btn-sm">
                            Proses
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Hasil Stemming:
            </div>
            <div class="card-body">
                @if(session('stemmed'))
                    <p>
                        {{ session('stemmed') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>