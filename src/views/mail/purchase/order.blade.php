@component('mail::message')
# Order Detail
{{ $order['customer']['name'] ?? 'Customer Name' }}

{{ $order['order_id'] ?? '' }}

{{ $order['cross_reference'] ?? '' }}

{{ $order['product_detail'] ?? '' }}


{{ $order['amount'] ?? '' }}

{{ $order['currency_code'] ?? '' }}

@component('mail::button', ['url' => ''])
    View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
