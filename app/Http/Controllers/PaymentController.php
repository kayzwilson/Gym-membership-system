<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['subscription.member', 'subscription.plan'])
            ->latest()
            ->paginate(10);

        $totalRevenue = Payment::sum('amount');

        return view('payments.index', compact('payments', 'totalRevenue'));
    }

    public function create()
    {
        // Get subscriptions that don't have a payment yet
        $subscriptions = Subscription::with(['member', 'plan'])
            ->doesntHave('payment')
            ->latest()
            ->get();

        $preselected = request('subscription_id');

        return view('payments.create', compact('subscriptions', 'preselected'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id|unique:payments,subscription_id',
            'amount'          => 'required|numeric|min:0',
            'method'          => 'required|in:Cash,Mobile Money,Card',
            'payment_date'    => 'required|date',
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        return redirect()->route('payments.index');
    }

    public function edit(Payment $payment)
    {
        $subscriptions = Subscription::with(['member', 'plan'])->latest()->get();
        return view('payments.edit', compact('payment', 'subscriptions'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id|unique:payments,subscription_id,' . $payment->id,
            'amount'          => 'required|numeric|min:0',
            'method'          => 'required|in:Cash,Mobile Money,Card',
            'payment_date'    => 'required|date',
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}