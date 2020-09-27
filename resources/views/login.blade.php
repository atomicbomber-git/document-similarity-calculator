@extends("layouts.app")

@section("content")
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="usenname"> Nama Pengguna: </label>
                <input
                        id="usenname"
                        type="text"
                        placeholder="Nama Pengguna"
                        class="form-control @error("usenname") is-invalid @enderror"
                        name="usenname"
                        value="{{ old("usenname") }}"
                />
                @error("usenname")
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password"> Kata Sandi: </label>
            <input
                    id="password"
                    type="text"
                    placeholder="Kata Sandi"
                    class="form-control @error("password") is-invalid @enderror"
                    name="password"
                    value="{{ old("password") }}"
            />
            @error("password")
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
@endsection