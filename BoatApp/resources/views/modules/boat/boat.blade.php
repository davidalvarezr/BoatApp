@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               VIEW BOAT <br>
                Mode: {{ $mode }} <br>
                ID: {{ $id }}
            </div>
        </div>
    </div>
@endsection
