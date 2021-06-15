@extends('Payzone::layout')
@section('header')
    {{ __("Checkout with Payzone") }}
@endsection

@section('content')
    <form id="payzone-payment-form" name="payzone-payment-form" target="_self" method="POST" action="/process">
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <input type="hidden" name="OrderID" id="OrderID" value="{{ $order->id }}"/>
                    <input type="hidden" name="Amount" id="Amount" value="{{ $order->order_price }}"/>
                    <input type="hidden" name="OrderDescription" id="OrderDescription"  value="{{ $order->order_details }}"/>
                    <input type="hidden" name="CurrencyCode" id="CurrencyCode" value="{{ config('payzone.currencyCode') }}"/>
                    <input type="hidden" name="TransactionDateTime" id="TransactionDateTime" value="{{ today() }}"/>
                    <input type="hidden" name="TransactionType" id="TransactionType" value="{{ config('payzone.transactionType') }}"/>
                    <input type="hidden" name="CustomerName" value="{{ $order->customer->first_name }}  {{ $order->customer->last_name }}" id="CustomerName"/>
                    <input type="hidden" name="Address1" value="{{ $order->customer->address_line_1 }}" autocomplete="Address1"/>
                    <input type="hidden" name="Address2" id="Address2" value="{{ $order->customer->address_line_2 ?? '' }}"/>
                    <input type="hidden" name="Address3" id="Address3" value="{{ $order->customer->address_line_3 ?? '' }}"/>
                    <input type="hidden" name="Address4" id="Address4" value="{{ $order->customer->address_line_4 ?? '' }}"/>
                    <input type="hidden" name="City" id="City" value="{{ $order->customer->city ?? '' }}"/>
                    <input type="hidden" name="State" value="{{ $order->customer->county ?? '' }}" id="State"/>
                    <input type="hidden" name="PostCode" value="{{ $order->customer->postal_code ?? '' }}" id="PostCode"/>
                    <input type="hidden" name="CountryCode" value="{{ $order->customer->country ?? '' }}" id="PostCode"/>
                </div>
            </div>
            @if(config('payzone.integrationType') =='direct' || config('payzone.integrationType') =='transparent')
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <label for="CardName" class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                            <input type="text" name="CardName" value="{{ old('CardName') ?? '' }}" id="CardName" autocomplete="customer-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <label for="CardNumber" class="block text-sm font-medium text-gray-700">Card Number</label>
                            <input type="text" name="CardNumber" id="CardNumber" value="{{ old('CardNumber') ?? '' }}" autocomplete="card-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="CV2" class="block text-sm font-medium text-gray-700">CV2</label>
                            <input type="text" name="CV2" id="CV2" value="{{ old('CV2') ?? '' }}" autocomplete="CV2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="ExpiryDateMonth" class="block text-sm font-medium text-gray-700">Expiry Date Month</label>
                            <input type="text" name="ExpiryDateMonth" id="ExpiryDateMonth" value="{{ old('ExpiryDateMonth') ?? '' }}" autocomplete="Address3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="ExpiryDateYear" class="block text-sm font-medium text-gray-700">Expiry Year</label>
                            <input type="text" name="ExpiryDateYear" id="ExpiryDateYear" value="{{ old('ExpiryDateYear') ?? '' }}" autocomplete="Address4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                    </div>
                </div>
            @endif
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')@endsection
