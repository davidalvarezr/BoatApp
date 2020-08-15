@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                BOAT LIST <br>
                token: {{$token}}

                <token-setter access_token="{{$token}}"></token-setter>

                <personnal-access-token></personnal-access-token>


            </div>
        </div>
    </div>
@endsection
