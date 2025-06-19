<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class PaypalControllerNew extends Controller
{
    public function payment()
    {
        try {
            // Get the user's cart items
            $cart = Cart::where('user_id', auth()->id())
                      ->where('order_id', null)
                      ->with('product')
                      ->get()
                      ->toArray();

            if (empty($cart)) {
                return back()->with('error', 'Your cart is empty');
            }

            // Prepare order data
            $data = [];
            
            // Map cart items to PayPal format
            $data['items'] = array_map(function ($item) {
                return [
                    'name' => $item['product']['title'] ?? 'Product ' . $item['product_id'],
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
            $orderId = session()->get('id');
            Cart::where('user_id', auth()->id())
               ->where('order_id', null)
               ->update(['order_id' => $orderId]);

            // Initialize PayPal provider
            $provider = new PayPalClient;
            
            // Get configuration from config/paypal.php
            $provider->setApiCredentials(config('paypal'));
            
            // Log PayPal configuration (without sensitive data)
            Log::info('PayPal Configuration:', [
                'mode' => config('paypal.mode'),
                'sandbox_client_id' => config('paypal.sandbox.client_id') ? '***' . substr(config('paypal.sandbox.client_id'), -4) : 'Not set',
                'http' => [
                    'verify' => config('paypal.http.verify'),
                    'timeout' => config('paypal.http.timeout'),
                ]
            ]);

            // Get access token
            $provider->getAccessToken();
            
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
                            'name' => substr($item['name'], 0, 127), 
                            'description' => substr($item['desc'], 0, 127), 
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
            $response = $provider->createOrder([
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

            Log::info('PayPal Order Response:', $response);

            if (empty($response['id'])) {
                throw new \Exception('Invalid response from PayPal: ' . json_encode($response));
            }

            // Find approval URL
            $approveLink = collect($response['links'] ?? [])->firstWhere('rel', 'approve');
            if (empty($approveLink['href'])) {
                throw new \Exception('No approval URL found in PayPal response');
            }

            return redirect($approveLink['href']);

        } catch (\Exception $e) {
            // Log detailed error
            Log::error('PayPal Payment Error: ' . $e->getMessage(), [
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

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->get('token'));

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Payment successful, process the order
            return redirect()->route('home')->with('success', 'Payment successful!');
        }

        return redirect()->route('cart.index')->with('error', 'Payment failed. Please try again.');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment was cancelled.');
    }
}
