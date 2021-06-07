@extends('Payzone::layout')

@section('header')
    {{ __("Payment in process") }}
@endsection

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0 lg:text-center">
            @switch($integrationType)
                @case('hosted')
                    @include('Payzone::hosted-paymentForm')
                @break

                @case('transparent')
                    @include('transparent-paymentform')
                @break

                @case('direct')
                    @if ($processed)
                        @if ($transactionResult->getStatusCode() === '3')
                            @include('Payzone::direct-three-d-secure')
                        @else
                            @include('Payzone::direct-paymentform')
                        @endif
                    @endif
                @break

                @default
                Default case...
            @endswitch
        </div>
    </div>
@endsection
@section('scripts')
    <script type='text/javascript'>
        window.addEventListener('load', function () {
            document.PayzonePaymentForm.submit();
        });
    </script>
@endsection
