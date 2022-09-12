@extends('layouts.app')

@section('title')
    Create Genre
@endsection

@section('content')
<section class="section">
<x-bread-crumb title="Users">
    <div class="breadcrumb-item"><a href="{{ route('config') }}">Config</a></div>
    <div class="breadcrumb-item">Add Quality</div>
</x-bread-crumb>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Genre</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('quality.store') }}" id="createQuality" method="POST"
                >
                    @csrf
                    <dvi class="row g-1 justify-content-center align-items-center ">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Quality</label>
                                <input type="text" class="form-control" name="quality" placeholder="create quality">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <a href="{{ route('quality.create') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button class="btn btn-primary px-4">Confirm</button>
                            </div>
                        </div>
                    </dvi>

                </form>
                <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="qualityTable">
                    <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th scope="col">#</th>
                        <th scope="col">Quality</th>
                        <th scope="col">Control</th>
                        <th scope="col">Created_at</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@section('scripts')

    {!! JsValidator::formRequest('\App\Http\Requests\StoreQualityRequest', '#createQuality') !!}

    <script>
        $(function() {
         let table =   $('#qualityTable').DataTable({
                ajax: '{{route('quality.ssd')}}',
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
                    data: 'quality_name',
                    name: 'quality_name',
                },
                {
                    data:'action',
                    name:'action',
                },
                {
                    data:'created_at',
                    name:'created_at',
                }
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
                            url: `/quality/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        });
    </script>
@endsection

{{--@forelse($qualities as $quality)--}}
{{--    <tr>--}}
{{--        <td>{{$quality->id}}</td>--}}
{{--        <td>{{$quality->quality_name}}</td>--}}
{{--        <td>--}}
{{--            <form action="{{ route('quality.destroy',$quality->id) }}" class="d-inline" method="post">--}}
{{--                @csrf--}}
{{--                @method('delete')--}}
{{--                <button class="btn btn-sm btn-danger">--}}
{{--                    <i class="fas fa-trash-alt fa-fw"></i>--}}
{{--                </button>--}}
{{--            </form>--}}
{{--            <a href="{{ route('quality.edit',$quality->id) }}" class="btn btn-sm btn-warning">--}}
{{--                <i class="fas fa-pencil-alt fa-fw"></i>--}}
{{--            </a>--}}
{{--        </td>--}}
{{--        <td>--}}
{{--            <p class="small mb-0">--}}
{{--                <i class="fas fa-calendar"></i>--}}
{{--                {{ $quality->created_at->format("Y-m-d") }}--}}
{{--            </p>--}}
{{--            <p class="mb-0 small">--}}
{{--                <i class="fas fa-clock"></i>--}}
{{--                {{ $quality->created_at->format("H:i a") }}--}}
{{--            </p>--}}

{{--        </td>--}}
{{--    </tr>--}}
{{--@empty--}}
{{--    <p class="text-danger fw-bolder text-center fa-2x my-3">There is no quality</p>--}}
{{--@endforelse--}}
