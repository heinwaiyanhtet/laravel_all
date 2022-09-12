@extends('layouts.app')

@section('title')
    Create Genre
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('genre.index') }}">Genre Lists</a></div>
            <div class="breadcrumb-item">Add Genre</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Genre</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('genre.update',$genre->id) }}" id="createGenre" method="POST"
                        >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Genre</label>
                                <input type="text" class="form-control w-100" name="genre" value="{{old('genre',$genre->genre)}}">
                            </div>
                            <div class="text-center">
                                <a href="{{ route('genre.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button class="btn btn-primary px-4">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest("\App\Http\Requests\UpdateGenreRequest", '#updateGenre') !!}
    <script>

    </script>
@endsection
