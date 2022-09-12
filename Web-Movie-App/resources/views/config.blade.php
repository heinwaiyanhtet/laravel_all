@extends('layouts.app')

@section('title')
    Create Config
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="#">Config</a></div>
        </x-bread-crumb>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" class="w-100">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                @include('genre.show')
                            </div>
                            <div class="col-12 col-lg-4">
                                @include('quality.show')
                            </div>
                            <div class="col-12 col-lg-4">
                                @include('server.show')
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
