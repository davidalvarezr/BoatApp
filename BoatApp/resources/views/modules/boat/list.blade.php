@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
{{--                BOAT LIST <br>--}}
{{--                token: {{$token}}--}}
                <!-- we store the token here because that is our entrypoint page -->
                <token-setter access_token="{{$token}}"></token-setter>

                <boat-list :boats="{{$boats}}"></boat-list>
            </div>
        </div>
    </div>
@endsection
