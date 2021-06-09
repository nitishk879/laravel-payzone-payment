@component('mail::message')
# Order Detail

@component('mail::table')
      Particular       | Description         |
    | ------------- |:-------------:|
      Name      | {{ $order['customer']['first_name'] ?? '' }} {{ $order['customer']['last_name'] ?? '' }}
      Order     | {{ $order['id'] ?? '' }}
      Trans. Id | {{ $order['cross_reference'] ?? '' }}
      Desc.     | {{ $order['order_details'] ?? '' }}
      Status    | {{ $order['order_status'] ?? '' }}
      Amount    | {{ $order['total_price'] ?? '' }}
@endcomponent

@component('mail::button', ['url' => '/orders/'.$order['id']])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
