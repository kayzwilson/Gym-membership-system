<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Member;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('member.user', 'membershipPlan')
            ->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $plans = MembershipPlan::where('status', 'active')->get();
        return view('payments.create', compact('members', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:paid,pending,failed',
            'payment_method' => 'required|string',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully!');
    }

    public function show(Payment $payment)
    {
        $payment->load('member.user', 'membershipPlan');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $plans = MembershipPlan::where('status', 'active')->get();
        return view('payments.edit', compact('payment', 'members', 'plans'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:paid,pending,failed',
            'payment_method' => 'required|string',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully!');
    }

    public function invoice(Payment $payment)
{
    $payment->load('member.user', 'membershipPlan');
    return view('payments.invoice', compact('payment'));
}
}