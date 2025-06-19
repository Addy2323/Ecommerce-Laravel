<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Facades\PayPal;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Models\Cart;
use App\Models\Product;
use DB;
class PaypalController extends Controller
{
    public function payment()
    {
        try {
            // Get the user's cart items
            $cart = Cart::where('user_id', auth()->user()->id)
                      ->where('order_id', null)
                      ->get()
                      ->toArray();

            if (empty($cart)) {
                return back()->with('error', 'Your cart is empty');
            }

            // Prepare order data
            $data = [];
            
            // Map cart items to PayPal format
            $data['items'] = array_map(function ($item) {
                $product = Product::find($item['product_id']);
                return [
                    'name' => $product ? $product->title : 'Product ' . $item['product_id'],
                    'price' => (float) $item['price'],
                    'desc' => 'Thank you for your purchase',
                    'qty' => (int) $item['quantity']
                ];
            }, $cart);

            // Generate order details
            $data['invoice_id'] = 'ORD-' . strtoupper(uniqid());
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');

            // Calculate total
            $data['total'] = array_reduce($data['items'], function($carry, $item) {
                return $carry + ($item['price'] * $item['qty']);
            }, 0);

            // Apply coupon if exists
            if (session('coupon')) {
                $data['shipping_discount'] = (float) session('coupon')['value'];
                $data['total'] = max(0, $data['total'] - $data['shipping_discount']);
            }

            // Update cart with order ID
            Cart::where('user_id', auth()->id())
               ->where('order_id', null)
               ->update(['order_id' => session()->get('id')]);

            // Initialize PayPal provider
            $provider = PayPal::setProvider();
            
            // Log PayPal configuration (without sensitive data)
            \Log::info('PayPal Configuration:', [
                'mode' => config('paypal.mode'),
                'sandbox_client_id' => config('paypal.sandbox.client_id') ? '***' . substr(config('paypal.sandbox.client_id'), -4) : 'Not set',
                'http' => [
                    'verify' => config('paypal.http.verify'),
                    'timeout' => config('paypal.http.timeout'),
                ]
            ]);

            // Get access token
            $accessToken = $provider->getAccessToken();
            if (!$accessToken) {
                throw new \Exception('Failed to get PayPal access token');
            }
            \Log::info('PayPal Access Token Retrieved');

            // Prepare purchase units
            $purchaseUnits = [
                [
                    'reference_id' => $data['invoice_id'],
                    'description' => $data['invoice_description'],
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($data['total'], 2, '.', ''),
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'USD',
                                'value' => number_format($data['total'], 2, '.', '')
                            ]
                        ]
                    ],
                    'items' => array_map(function($item) {
                        return [
                            'name' => substr($item['name'], 0, 127), // Max 127 chars
                            'description' => substr($item['desc'], 0, 127), // Max 127 chars
                            'quantity' => $item['qty'],
                            'unit_amount' => [
                                'currency_code' => 'USD',
                                'value' => number_format($item['price'], 2, '.', '')
                            ]
                        ];
                    }, $data['items'])
                ]
            ];

            // Create order
            $order = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => $purchaseUnits,
                'application_context' => [
                    'brand_name' => config('app.name', 'Laravel E-Commerce'),
                    'shipping_preference' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'cancel_url' => $data['cancel_url'],
                    'return_url' => $data['return_url']
                ]
            ]);

            \Log::info('PayPal Order Created:', ['order_id' => $order['id'] ?? 'unknown']);

            if (empty($order['id'])) {
                throw new \Exception('Invalid response from PayPal: Missing order ID');
            }

            // Find approval URL
            $approveLink = collect($order['links'] ?? [])->firstWhere('rel', 'approve');
            if (empty($approveLink['href'])) {
                throw new \Exception('No approval URL found in PayPal response');
            }

            return redirect($approveLink['href']);

        } catch (\Exception $e) {
            // Log detailed error
            \Log::error('PayPal Payment Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id()
            ]);

            $errorMessage = 'Failed to process PayPal payment. ';
            if (str_contains($e->getMessage(), 'AUTHENTICATION_FAILURE')) {
                $errorMessage .= 'Authentication failed. Please check your PayPal credentials.';
            } else {
                $errorMessage .= 'Please try again or contact support if the problem persists.';
            }

            return back()->with('error', $errorMessage);
        }
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = PayPal::setProvider('express_checkout');
        $response = $provider->getExpressCheckoutDetails($request->token);
        // return $response;
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            request()->session()->flash('success','You have successfully paid through Paypal! Thank You');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('home');
        }
  
        request()->session()->flash('error','Something went wrong please try again!!!');
        return redirect()->back();
    }
}
