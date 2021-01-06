<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\PayRequest;
use App\Models\Order;
use App\Traits\PlaceToPayRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    use PlaceToPayRequest;
    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::all([
            'id',
            'status',
            'description',
            'reference',
            'processUrl',
            'amount',
            'internalReference',
            'requestId',
            'expiration'
        ]);

        return view('main.index', ['orders' => $orders]);

    }

    /**
     * @param OrderCreateRequest $request
     * @return RedirectResponse
     */
    public function store(OrderCreateRequest $request): RedirectResponse
    {
        $order = Order::create($request->all());
        $order->update([
            'returnUrl' => route('orders.show', $order->id)
        ]);

        $payment = [
            'reference' => $order->reference,
            'description' => $order->description,
            'amount' => [
                'currency' => 'COP',
                'total' => $order->amount
            ]
        ];

        $expiration = date('c', strtotime('+1 days'));

        $response = $this->requestPayment($payment, $expiration, $order->returnUrl);

        return $this->response($response, $order);
    }

    /**
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        return view('main.show', [
            'order' => $order
        ]);
    }

    public function verify(Order $order): RedirectResponse
    {
        return $this->getRequestInformation($order);
    }

    /**
     * @param PayRequest $request
     * @param Order $order
     */
    public function update(PayRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect(route('orders.show', $order));
    }
}
