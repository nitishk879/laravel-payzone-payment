@extends('Payzone::layout')
@section('header')
    {{ __("First example") }}
@endsection
@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
            <form id="payzone-payment-form" name="payzone-payment-form" target="_self" method="POST" action="/process">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="OrderID" class="block text-sm font-medium text-gray-700">Order Id</label>
                                <input type="text" readonly name="OrderID" id="OrderID" value="{{ $order->id ?? '' }}" autocomplete="order-id" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="Amount" class="block text-sm font-medium text-gray-700">Amount</label>
                                <input type="text" readonly name="Amount" id="Amount" value="{{ $order->amount ?? '' }}" autocomplete="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="OrderDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                <input type="text" readonly name="OrderDescription" id="OrderDescription" value="{{ $order->product_detail ?? 'Product was purchased' }}" autocomplete="order-description" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <input type="hidden" name="CurrencyCode" id="CurrencyCode" value="{{ $order->currency_code ?? 826 }}">
                            <input type="hidden" name="TransactionDateTime" id="TransactionDateTime" value="{{ $order->created_at }}">
                            <input type="hidden" readonly name="TransactionType" id="TransactionType" value="{{ $transactiontype ?? 'SALE' }}">
                        </div>
                    </div>
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="CustomerName" class="block text-sm font-medium text-gray-700">Customer Name</label>
                                <input type="text" name="CustomerName" value="{{ $customername ?? config('payzone.customername') ?? 'John watson' }}" id="CustomerName" autocomplete="customer-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="Address1" class="block text-sm font-medium text-gray-700">Address line1</label>
                                <input type="text" name="Address1" value="{{ config('payzone.address1') ?? '32 Mulberry Street' }}" autocomplete="Address1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="Address2" class="block text-sm font-medium text-gray-700">Address line2</label>
                                <input type="text" name="Address2" value="{{ config('payzone.address2') ?? '' }}" autocomplete="Address2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="Address3" class="block text-sm font-medium text-gray-700">Address line3</label>
                                <input type="text" name="Address3" value="{{ config('payzone.address3') ?? '' }}" autocomplete="Address3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="Address4" class="block text-sm font-medium text-gray-700">Address line4</label>
                                <input type="text" name="Address4" value="{{ config('payzone.address4') ?? '' }}" autocomplete="Address4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="City" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" readonly name="City" id="City" value="{{ config('payzone.city') ?? 'East fort' }}" autocomplete="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="State" class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" name="State" value="{{ config('payzone.state') ?? 'Voiletdell' }}" id="State" autocomplete="state" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="PostCode" class="block text-sm font-medium text-gray-700">PostCode</label>
                                <input type="text" name="PostCode" value="{{ config('payzone.postcode') ?? 'VL14 8PA' }}" id="PostCode" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="CountryCode" class="block text-sm font-medium text-gray-700">Country Code</label>
                                <input type="text" readonly name="CountryCode" value="{{ config('payzone.countrycode') ?? 826 }}" id="CountryCode" autocomplete="country-code" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                    @if($integrationType =='direct' || $integrationType =='transparent')
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="CardName" class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                                    <input type="text" name="CardName" value="{{ $cardname ?? config('payzone.cardname') ?? 'John Watson'}}" id="CardName" autocomplete="customer-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="CardNumber" class="block text-sm font-medium text-gray-700">Card Number</label>
                                    <input type="text" name="CardNumber" id="CardNumber" value="{{ $cardnumber ?? config('payzone.cardnumber') ?? '4976000000003436' }}" autocomplete="card-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="CV2" class="block text-sm font-medium text-gray-700">CV2</label>
                                    <input type="text" name="CV2" id="CV2" value="{{ $cv2 ?? config('payzone.cv2') ?? 452 }}" autocomplete="CV2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="ExpiryDateMonth" class="block text-sm font-medium text-gray-700">Expiry Date Month</label>
                                    <input type="text" name="ExpiryDateMonth" id="ExpiryDateMonth" value="{{ $expirydatemonth ?? config('payzone.expirydatemonth') ?? '01' }}" autocomplete="Address3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="ExpiryDateYear" class="block text-sm font-medium text-gray-700">Address line4</label>
                                    <input type="text" name="ExpiryDateYear" id="ExpiryDateYear" value="{{ $expirydateyear ?? config('payzone.expirydateyear') ?? '25' }}" autocomplete="Address4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
        </div>
    </div>
@endsection
@section('scripts')@endsection
