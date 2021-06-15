@extends('Payzone::layout')
@section('header')
    {{ __("Checkout with Payzone") }}
@endsection

@php $order = \Svodya\Payzone\Models\Order::latest()->first();
$description = collect($checkout->items)->flatten()->whereNotNull('title') ?? collect($checkout->items)->flatten()->whereNotNull('name');
@endphp

@section('content')
    <form id="payzone-payment-form" name="payzone-payment-form" target="_self" method="POST" action="/process">
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="OrderID" class="block text-sm font-medium text-gray-700">Order Id</label>
                        <input type="text" readonly name="OrderID" id="OrderID" value="{{ $order ? $order->id+1 : 1 }}" autocomplete="order-id" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="Amount" class="block text-sm font-medium text-gray-700">Amount</label>
                        <input type="text" readonly id="Amount" value="{{ $checkout->totalPrice ?? '' }}" autocomplete="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-6">
                        <label for="OrderDescription" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" readonly name="OrderDescription" id="OrderDescription" value="{{ $description->implode('title', ', ') ?? $description->implode('name', ', ') ?? 'Product was purchased' }}" autocomplete="order-description" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <input type="hidden" name="Amount" id="Amount" value="{{ $checkout->totalPrice*100 }}">
                    <input type="hidden" name="CurrencyCode" id="CurrencyCode" value="{{ config('payzone.currencyCode') }}">
                    <input type="hidden" name="TransactionDateTime" id="TransactionDateTime" value="{{ today() }}">
                    <input type="hidden" name="TransactionType" id="TransactionType" value="{{ config('payzone.transactionType') }}">
                </div>
            </div>
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="CustomerName" class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text" name="CustomerName" value="{{ old('CustomerName') ?? '' }}" id="CustomerName" autocomplete="customer-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="EmailAddress" class="block text-sm font-medium text-gray-700">Customer Email</label>
                        <input type="text" name="EmailAddress" value="{{ old('EmailAddress') ?? '' }}" id="EmailAddress" autocomplete="customer-email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="PhoneNumber" class="block text-sm font-medium text-gray-700">Customer Phone</label>
                        <input type="text" name="PhoneNumber" value="{{ old('PhoneNumber') ?? '' }}" id="PhoneNumber" autocomplete="customer-phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="Address1" class="block text-sm font-medium text-gray-700">Address line1</label>
                        <input type="text" name="Address1" value="{{ old('Address1') ?? '' }}" autocomplete="Address1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="Address2" class="block text-sm font-medium text-gray-700">Address line2</label>
                        <input type="text" name="Address2" id="Address2" value="{{ old('Address2') ?? '' }}" autocomplete="Address2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="Address3" class="block text-sm font-medium text-gray-700">Address line3</label>
                        <input type="text" name="Address3" id="Address3" value="{{ old('Address3') ?? '' }}" autocomplete="Address3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="Address4" class="block text-sm font-medium text-gray-700">Address line4</label>
                        <input type="text" name="Address4" id="Address4" value="{{ old('Address4') ?? '' }}" autocomplete="Address4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="City" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="City" id="City" value="{{ old('City') ?? '' }}" autocomplete="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="State" class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" name="State" value="{{ old('State') ?? '' }}" id="State" autocomplete="state" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                        <label for="PostCode" class="block text-sm font-medium text-gray-700">PostCode</label>
                        <input type="text" name="PostCode" value="{{ old('PostCode') ?? '' }}" id="PostCode" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-6">
                        <label for="CountryCode" class="block text-sm font-medium text-gray-700">Country / Region</label>
                        <select name="CountryCode"  id="CountryCode" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option selected value="{{ old('CountryCode') ?? config('payzone.countrycode') ?? '826' }}">United Kingdom</option>
                            <option value="840">United State</option>
                            <option value="036">Australia</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
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
