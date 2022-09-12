@extends('layouts.app')

@section('title')
    Create Server
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('genre.index') }}">Server Lists</a></div>
            <div class="breadcrumb-item">Edit Server</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Server</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{route('server.update',$server->id)}}" id="storeServer" method="POST"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Server Name</label>
                                <input type="text" class="form-control" value="{{old('servername',$server->name)}}" name="serverName" placeholder="Server Name">
                            </div>

                            <div class="mb-3">
                                <label for="serverIconPhoto" class="form-label">Server Icon</label>
                                <input class="form-control" type="file"  id="serverIconPhoto" name="serverIcon">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Url</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{old('url',$server->url)}}" name="serverUrl" placeholder="server url">
                            </div>

                            <div class="text-center">
                                <a href="{{ route('server.create') }}" class="btn btn-danger mr-2">Cancel</a>
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
    {!! JsValidator::formRequest("\App\Http\Requests\StoreServerRequest", '#storeServer') !!}
    <script>

    </script>
@endsection
