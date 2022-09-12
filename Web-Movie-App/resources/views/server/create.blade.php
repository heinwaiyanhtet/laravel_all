@extends('layouts.app')

@section('title')
    Create Server
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('config') }}">Config</a></div>
            <div class="breadcrumb-item">Add Server</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Server</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('server.store') }}" id="createServer" method="POST"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            <div class="form-group">
                                <label>Server Name</label>
                                <input type="text" class="form-control" name="serverName" placeholder="Server Name">
                            </div>

                            <div class="mb-3">
                                <label for="serverIconPhoto" class="form-label">Server Icon</label>
                                <input class="form-control" type="file"  id="serverIconPhoto" name="serverIcon">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Url</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="serverUrl" placeholder="server url">
                            </div>

                            <div class="text-center">
                                <a href="{{ route('user.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button class="btn btn-primary px-4">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="serverTable">
                            <thead>
                            <th class="no-sort"></th>
                            <th>#</th>
                            <th>ServerName</th>
                            <th>ServerIcon</th>
                            <th>ServerUrl</th>
                            <th>Control</th>
                            <th>created_at</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest("\App\Http\Requests\StoreServerRequest", '#createServer') !!}
    <script>
        $(document).ready(function () {
            var table = $('#serverTable').DataTable({
                ajax: '{{ route('server.ssd') }}',
                columns: [
                    {
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data:'id',
                        name:'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data:'icon',
                        name:'icon',
                    },
                    {
                        data:'url',
                        name: 'url',
                    },
                    {
                        data:'action',
                        name:'action',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
            });
            $(document).on('click', '.del-btn', function(e, id) {
                e.preventDefault();
                var id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method: "DELETE",
                            url: `/server/${id}`,
                        }).done(function(res) {
                            table.ajax.reload(); //error
                        })
                    }
                });
            })
        })
    </script>
@endsection
