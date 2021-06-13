@extends('Payzone::layout')

@section('header')
    {{ __("Thank you") }}
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
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg text-red-400 px-3 py-4">
                            @if($errors)
                                <h1>Error:</h1>
                                @foreach ($errors as $error)
                                    {{ $error }}
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
