@extends('Payzone::layout')

@section('header')
    {{ __("Processing Payment with 3D Secure Payment gateway") }}
@endsection

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
            <div class="lg:text-center">
                @if($transactionResult->getStatusCode() === '3')
                    <form id="PayzonePaReqForm" name="PayzonePaReqForm" method="post" action='{{ $transactionResult->getAcsUrl() }}' target="ACSFrame">
                        <input type="hidden" name="PaReq" value="{{ $transactionResult->getPaReq() }}"/>
                        <input type="hidden" name="MD" value="{{ $transactionResult->getCrossReference() }}"/>
                        <input type="hidden" name="TermUrl" value='{{ config('payzone.process') }}'/>
                    </form>
                    <iframe src='/vendor/payzone/loading.svg' id="ACSFrame" name="ACSFrame" width="100%" height="400" frameborder="0" scrolling='no'></iframe>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type='text/javascript'>
        window.addEventListener('load', function () {
            document.PayzonePaReqForm.submit();
        });
    </script>
@endsection
