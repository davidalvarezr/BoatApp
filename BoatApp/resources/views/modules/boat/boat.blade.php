@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                VIEW BOAT <br>
                Mode: {{ $mode }} <br>
                ID: {{ $id }}
                @if($mode === 'edit' || $mode === 'show')
                    <boat init-mode="{{$mode}}"
                          boat-id="{{$boat->id}}"
                          boat-name="{{$boat->name}}"
                          boat-description="{{$boat->description}}"></boat>
                @else
                    <boat init-mode="{{$mode}}"></boat>
                @endif

            </div>
        </div>
    </div>
@endsection
