@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                   <h1 @class(["aa" => true,"bb"=>false,"cc"]) >HaHa</h1>


                        @php

                        $arr = ["apple","orange","mango"];

                        @endphp

                        <script>

                            let arr = @json($arr);
                            console.log(arr);

                        </script>

                        <br>
                        <br>
                        <br>

                    {{ auth()->user() }}

                    {{ env("APP_NAME") }}
                        <br>
                    {{ env("DB_DATABASE") }}
                        <br>
                    {{ env('my_age',27) }}
                        <br>
                    {{ env("APP_NAME") }}
                        <br>
                    {{ now() }}
                        <br>
                    {{ config("database.connections.mysql.driver") }}
                        <br>
{{--                        @php--}}

{{--                        config(["app.timezone" => "abcd"]);--}}

{{--                        @endphp--}}

                    {{ config("app.timezone") }}
                        <br>
{{--                    {{ dd(config("my.gf")) }}--}}
                        <br>
{{--                    {{ (new \App\Info())->projectName }}--}}

                        <br>

                        @inject('aa',"App\Info")

                        {{ $aa->showProjectName() }}

                        <br>

                        @inject("bb","App\Info")

                        {{ $bb->projectName }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
