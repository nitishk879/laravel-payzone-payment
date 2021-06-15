Hey!
I've made a library package for laravel6/7 users. This package can be useful for UK based companies.

This is a [_takepayments_] payment gateway which is not available from their website. So, I decided to make it as a library for laravel users. I'm  trying to develope it under MIT license.

    `composer require svodya/payzone`

All you need to store your data to _cart_ `Session('cart')` or you can make checkout form as well. A post method need to be there action will be `/process`

Keys need to be set in your `.env` file

    PAYZONE_MERCHANT_ID=xxxxxxxxxx
    PAYZONE_MERCHANT_PASS=xxxxxxxx
    PAYZONE_MERCHANT_KEY=xxxxxxxxxxxxxxxxxx
    PAYZONE_DEFAULT_CURRENCY=$
    PAYZONE_CURRENCY_CODE=123

**Here is an example of checkout form:**

This form use tailwind css classes to design.

You can fetch last order id from your database to generate a value for your order. Order id is `autoincrement` value in database.

Main form `id="payzone-payment-form" name="payzone-payment-form" target="_self" method="POST" action="/process"`

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
                            <input type="text" readonly id="Amount" value="{{ $order->total_price ?? '' }}" autocomplete="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="OrderDescription" class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" readonly name="OrderDescription" id="OrderDescription" value="{{ $order->order_details ?? 'Product was purchased' }}" autocomplete="order-description" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <input type="hidden" name="Amount" id="Amount" value="{{ $order->order_price }}">
                        <input type="hidden" name="CurrencyCode" id="CurrencyCode" value="{{ config('payzone.currencyCode') }}">
                        <input type="hidden" name="TransactionDateTime" id="TransactionDateTime" value="{{ $order->created_at }}">
                        <input type="hidden" name="TransactionType" id="TransactionType" value="{{ config('payzone.transactionType') }}">
                    </div>
                </div>
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="CustomerName" class="block text-sm font-medium text-gray-700">Customer Name</label>
                            <input type="text" name="CustomerName" value="{{ old('CustomerName') ?? '' }}" id="CustomerName" autocomplete="customer-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="Address1" class="block text-sm font-medium text-gray-700">Address line1</label>
                            <input type="text" name="Address1" value="{{ old('Address1') ?? '' }}" autocomplete="Address1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="Address2" class="block text-sm font-medium text-gray-700">Address line2</label>
                            <input type="text" name="Address2" id="Address2" value="{{ old('Address2') ?? '' }}" autocomplete="Address2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="Address3" class="block text-sm font-medium text-gray-700">Address line3</label>
                            <input type="text" name="Address3" id="Address3" value="{{ old('Address3') ?? '' }}" autocomplete="Address3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="Address4" class="block text-sm font-medium text-gray-700">Address line4</label>
                            <input type="text" name="Address4" id="Address4" value="{{ old('Address4') ?? '' }}" autocomplete="Address4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="City" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" name="City" id="City" value="{{ old('City') ?? '' }}" autocomplete="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="State" class="block text-sm font-medium text-gray-700">State</label>
                            <input type="text" name="State" value="{{ old('State') ?? '' }}" id="State" autocomplete="state" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="PostCode" class="block text-sm font-medium text-gray-700">PostCode</label>
                            <input type="text" name="PostCode" value="{{ old('PostCode') ?? '' }}" id="PostCode" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                            <label for="CountryCode" class="block text-sm font-medium text-gray-700">Country Code</label>
                            <input type="text" name="CountryCode" value="{{ old('CountryCode') ?? '' }}" id="CountryCode" autocomplete="country-code" class="mt-1 text-gray-400 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                    </div>
                </div>
                @if(config('payzone.integrationType') =='direct' || config('payzone.integrationType') =='transparent')
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="CardName" class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                                <input type="text" name="CardName" value="{{ old('CardName') ?? '' }}" id="CardName" autocomplete="customer-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
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
---------------------------------------------------------------------------------------------------------
Publish your required files as follows:

To publish Configuration file

    `php artisan vendor:publish --tag=config`

To publish Assets

    `php artisan vendor:publish --tag=public --force`

Here is two sample card details provided by payzone or Take payments for test purpose.

Test card details:

    {
      "test1": {
        "customername": "Geoff Wayne",
        "address1": "113 Broad Street West",
        "address2": "",
        "address3": "",
        "address4": "",
        "city": "Oldpine",
        "state": "Strongbarrow",
        "postcode": "SB42 1SX",
        "countrycode": "826",
    
        "cardname": "Geoff Wayne",
        "cardnumber": "4976350000006891",
        "cv2": "341",
        "expirydatemonth": "01",
        "expirydateyear": "25"
      },
      "test2": {
        "customername": "John watson",
        "address1": "32 Mulberry Street",
        "address2": "",
        "address3": "",
        "address4": "",
        "city": "East fort",
        "state": "Voiletdell",
        "postcode": "VL14 8PA",
        "countrycode": "826",
    
        "cardname": "John Watson",
        "cardnumber": "4976000000003436",
        "cv2": "452",
        "expirydatemonth": "01",
        "expirydateyear": "25"
      }
    }
