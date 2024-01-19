<!DOCTYPE html>
<html>
<head>
    <title>Pesel Form for CarSmile test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            CarSmile Test
        </div>
        <div class="card-body">
            @if(isset( $ok ))
                <div class="alert alert-success">
                    {!! $ok !!}
                </div>
            @endif

            <form name="pesel-form" id="pesel-form" method="post" action="{{url('check-form')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="pesel">PESEL</label>
                    <input type="text" id="pesel" name="pesel" value="{{ old('pesel') }}" class="form-control @error('pesel') is-invalid @enderror">
                    @error('pesel')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Płeć</label>
                    <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                        @foreach(['' => 'Wybierz', 2 => 'Kobieta', 1 => 'Mężczyzna'] as $key => $option)
                            @if (old('gender') == $key)
                                <option value="{{ $key }}" selected>{{ $option }}</option>
                            @else
                                <option value="{{ $key }}">{{ $option }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Zapisz</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
