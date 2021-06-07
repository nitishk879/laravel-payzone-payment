@extends('Payzone::layout')

@section('header')
    {{ __("Call back Page") }}
@endsection

@section('content')
    @if($validated || isset($processing))
        @switch(config('payzone.integrationType'))
            @case('hosted')
                <h3>Response from SERVER needs data to be saved & accessed from the merchants sytem</h3>
                <h3>The transaction response object below will be empty by default as there is save / retrieve functonality in this demo code base</h3>
                @include('Payzone::response')
            @break
            @case('transparent')
                @if(isset($_POST['PaRes']) || isset($_POST['PaREQ']))
                    @include('Payzone::transparent-3dsecure')
                @else
                    @include('Payzone::response')
                @endif
            @break
            @case('direct')
                @if(isset($_POST['PaRes']) || isset($_POST['PaREQ']))
                    @include('Payzone::direct-three-d-secure')
                @else
                    @include('Payzone::response')
                @endif
            @break
            @default
            # code....
        @endswitch
    @endif
    <div class='error-container'>
        @if($errors)
            <h1>Error Occured:</h1>
            @foreach ($errors as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>
@endsection
@section('scripts')

@endsection
