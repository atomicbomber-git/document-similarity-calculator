@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card">
            <form action="{{ route("login") }}"
                  method="POST"
            >
                @csrf
                @method("POST")
                <div class="card-body">
                    <div class="form-group">
                        <label for="username"> Nama Pengguna: </label>
                        <input
                                id="username"
                                type="text"
                                placeholder="Nama Pengguna"
                                class="form-control @if($errors->has("password")) is-invalid @endif"
                                name="username"
                                value="{{ old("username") }}"
                        />
                        @if($errors->has("username"))
                            <span class="invalid-feedback">
                            {{ $errors->first("username") }}
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password"> Kata Sandi: </label>
                        <input
                                id="password"
                                type="password"
                                placeholder="Kata Sandi"
                                class="form-control @if($errors->has("password")) is-invalid @endif"
                                name="password"
                                value="{{ old("password") }}"
                        />
                        @if($errors->has("password"))
                            <span class="invalid-feedback">
                        {{ $errors->first("password") }}
                    </span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection