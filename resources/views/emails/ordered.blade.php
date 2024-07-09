<style>
	table {
		width: 100%;
	}
	
	td {
		text-align: right;
	}
</style>
@component('mail::message')

# {{ $title }}


## {{ __( 'order_wizard.confirm_order.labels.delivery') }} 
{{ __( 'order_wizard.confirm_order.labels.delivery_name') }}: {{ $order->name}} <br />
{{ __('order_wizard.confirm_order.labels.delivery_street')}}: {{ $order->street }} <br />
{{ __('order_wizard.confirm_order.labels.delivery_building_number')}}: {{ $order->building_number }} <br />
{{ __('order_wizard.confirm_order.labels.delivery_flat_number')}}: {{ $order->flat_number }} <br />
{{ __('order_wizard.confirm_order.labels.delivery_city')}}: {{ $order->city }} <br />
{{ __('order_wizard.confirm_order.labels.delivery_postcode')}}: {{ $order->postcode }} <br />

## {{ __( 'order_wizard.confirm_order.labels.total_cost') }} 
{{ __( 'order_wizard.confirm_order.labels.total_qty_items') }}: {{ $order->items->count()}} <br />
{{ __('order_wizard.confirm_order.labels.total_cost')}}: {{ number_format($order->total_cost, 2) }} {{__('translation.currency')}}

## {{ __('order_wizard.email_notification.labels.ordered_products') }} <br />
|{{ __('order_wizard.confirm_order.columns.tariff') }}|{{ __('order_wizard.confirm_order.columns.qty') }}|{{ __('order_wizard.confirm_order.columns.unit_price') }}|{{ __('order_wizard.confirm_order.columns.cost') }}|
|----------------------------------------------------------------|------------------------------|-----------------------------|-----------------------------|
@foreach ($order->items as $item)
|{{ $item->tariff->name }}|{{ $item->qty }}|{{ $item->price }} {{__('translation.currency')}}|{{ $item->cost }} {{__('translation.currency')}}|
@endforeach

@endcomponent