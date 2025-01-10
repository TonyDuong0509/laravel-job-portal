<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class CompanyOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('company_id', Auth::user()->company?->id)->paginate(20);
        return view('frontend.company-dashboard.order.index', compact('orders'));
    }

    public function show(string $id): View
    {
        $order = Order::findOrFail($id);
        return view('frontend.company-dashboard.order.show', compact('order'));
    }

    public function invoice(string $id)
    {
        $order = Order::findOrFail($id);

        $customer = new Buyer([
            'name'          => $order->company->name,
            'custom_fields' => [
                'email' => $order->company->email,
                'transaction' => $order->transaction_id,
                'payment_method' => $order->payment_provider,
            ],
        ]);

        $seller = new Party([
            'name'          => config('settings.site_name'),
            'phone'         => config('settings.site_phone'),
            'custom_fields' => [
                'email' => config('settings.site_email')
            ],
        ]);

        $item = InvoiceItem::make($order->package_name . ' Plan')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->series($order->order_id)
            ->currencyCode($order->paid_in_currency)
            ->currencySymbol($order->paid_in_currency)
            ->buyer($customer)
            ->seller($seller)
            ->status('paid')
            ->payUntilDays(0)
            ->addItem($item);

        return $invoice->download();
    }
}
