@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        Category List
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <a href="{{ route('category.create') }}" class="btn btn-primary">
                                Create Category
                            </a>
                        </div>

                        @if(session('status'))
                            <p class="alert alert-success">
                                {{ session('status') }}
                            </p>
                        @endif
                        <table class="table table-hover table-bordered align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Photo</th>
                                <th>Control</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>
                                        {{ $category->user->name ?? "Unknown User" }}
                                    </td>
                                    <td>

                                        @forelse($category->photos  as $photo)
                                            <a class="venobox" data-gall="img{{ $category->id }}" href="{{ asset('storage/photo/'.$photo->name) }}">
                                                <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="rounded-circle border border-2 border-white shadow-sm list-thumbnail" height="40" alt="image alt"/>
                                            </a>

                                        @empty
                                            <p class="text-muted">No Photo</p>
                                        @endforelse
                                    </td>
                                    <td>

                                        <form action="{{ route('category.destroy',$category->id) }}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-pencil-alt fa-fw"></i>
                                        </a>

                                    </td>
                                    <td>
                                        <p class="small mb-0">
                                            <i class="fas fa-calendar"></i>
                                            {{ $category->created_at->format("Y-m-d") }}
                                        </p>
                                        <p class="mb-0 small">
                                            <i class="fas fa-clock"></i>
                                            {{ $category->created_at->format("H:i a") }}
                                        </p>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">There is no Category</td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
