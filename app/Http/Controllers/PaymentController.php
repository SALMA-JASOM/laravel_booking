<?php

namespace App\Http\Controllers;
use App\Models\Inquiry;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handleBookingAndPayment(Request $request, $propertyId)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'visit_date' => 'required|date|after_or_equal:today',
        'visit_time' => 'required',
        'message' => 'nullable|string|max:1000',
    ]);

    // Save the inquiry
    $inquiry = Inquiry::create([
        'property_id' => $propertyId,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'visit_date' => $validated['visit_date'],
        'visit_time' => $validated['visit_time'],
        'message' => $validated['message'] ?? null,
        'payment_status' => 'Pending',
    ]);

    // Initiate PayPal Payment
    $provider = new \Srmklive\PayPal\Services\PayPal;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();

    $response = $provider->createOrder([
        "intent" => "CAPTURE",
        "purchase_units" => [
            [
                "amount" => [
                    "currency_code" => "USD",
                    "value" => "20.00",
                ],
            ],
        ],
        "application_context" => [
            "return_url" => route('payment.success'),
            "cancel_url" => route('payment.cancel'),
        ],
    ]);

    if (isset($response['id'])) {
        session(['inquiry_id' => $inquiry->id]); // Store inquiry ID
        return redirect($response['links'][1]['href']); // Redirect to PayPal
    }

    return back()->with('error', 'Payment initialization failed.');
}
public function paymentSuccess(Request $request)
{
    $provider = new \Srmklive\PayPal\Services\PayPal;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();

    $response = $provider->capturePaymentOrder($request->query('token'));

    if (isset($response['status']) && $response['status'] == 'COMPLETED') {
        $inquiryId = session('inquiry_id');
        Inquiry::where('id', $inquiryId)->update(['payment_status' => 'Paid']);

        return redirect()->route('properties.index')->with('success', 'Your booking was successful and payment completed.');
    }

    return redirect()->route('properties.index')->with('error', 'Payment failed.');
}
public function paymentCancel()
{
    return redirect()->route('properties.index')->with('error', 'Payment was cancelled.');
}

}
