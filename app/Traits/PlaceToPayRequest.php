<?php


namespace App\Traits;

use App\Constants\Orders;
use App\Models\Order;
use GuzzleHttp\Client;
use http\Client\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

trait PlaceToPayRequest
{
    use PlaceToPayAuth;

    public function requestPayment(array $payment, string $expiration, string $url)
    {
        try {
            $response = $this->getClient()->post('https://test.placetopay.com/redirection/api/session/', [
                'json'=> [
                    'auth'       => $this->getAuth(),
                    'payment'    => $payment,
                    'expiration' => $expiration,
                    'returnUrl'  => $url,
                    'ipAddress'  => request()->getClientIp(),
                    'userAgent'  => request()->userAgent()
                ]
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            return json_encode([
                'status' => [
                    'status' => Orders::FAILED,
                    'reason' => 'FAILED',
                    'message' => $e->getMessage(),
                    'date' => date('c'),
                ],
            ], JSON_THROW_ON_ERROR);
        }
    }

    public function getRequestInformation(Order $order)
    {
        $response = $this->getClient()
            ->post('https://test.placetopay.com/redirection/api/session/' . $order->requestId, [
            'json'=> [
                'auth'       => $this->getAuth()
            ]
        ]);

        return $this->response(json_decode($response->getBody()->getContents()), $order);
    }

    private function getClient(): Client
    {
        return new Client();
    }

    /**
     * @param $response
     * @param Order $order
     * @return RedirectResponse|View
     */
    public function response($response, Order $order)
    {
        $status = $response->status->status;

        switch ($status) {
            case Orders::OK:
                $order->update([
                    'requestId' => $response->requestId,
                    'processUrl' => $response->processUrl
                ]);
                return redirect()->away($response->processUrl)->send();
                break;
            case Orders::APPROVED:
                $order->update([
                    'status' => Orders::APPROVED,
                    'expiration' => now()->addDays(30)->toDateString()
                ]);
                return redirect(route('orders.show', $order))->with([
                    'success' => 'Pago aprobado!'
                ]);
                break;
            case Orders::FAILED:
                redirect()->back()->withErrors([
                    'error' => $response->status->message
                ]);
                break;
            case Orders::REJECTED:
                $order->update([
                    'status' => Orders::REJECTED,
                ]);
                return redirect(route('orders.show', $order))->with([
                    'success' => 'Pago rechazado!'
                ]);
            case Orders::PENDING:
                return redirect(route('orders.show', $order))->with([
                    'success' => 'El pago aún no ha sido procesado!'
                ]);
                break;
        }
    }
}
