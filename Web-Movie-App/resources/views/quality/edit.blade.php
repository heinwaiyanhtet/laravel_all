@extends('layouts.app')

@section('title')
    Create Genre
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('genre.index') }}">Quality Lists</a></div>
            <div class="breadcrumb-item">Add Quality</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Quality</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('quality.update',$quality->id) }}" id="updateQuality" method="POST"
                        >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Genre</label>
                                <input type="text" class="form-control w-100" name="quality" value="{{$quality->quality_name}}">
                            </div>
                            <div class="text-center">
                                <a href="{{ route('quality.create') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button class="btn btn-primary px-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest("\App\Http\Requests\UpdateQualityRequest", '#updateQuality') !!}
    <script>

    </script>
@endsection
