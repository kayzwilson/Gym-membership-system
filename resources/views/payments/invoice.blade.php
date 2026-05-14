<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $payment->id }} - ShadexGym</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-gray-100 p-8">

    {{-- Print/Back Buttons --}}
    <div class="max-w-3xl mx-auto mb-4 flex space-x-3 no-print">
        <button onclick="window.print()"
            class="px-6 py-2 text-white font-semibold rounded-lg"
            style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <i class="fas fa-print mr-2"></i>Print Invoice
        </button>
        <a href="{{ route('payments.index') }}"
           class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    {{-- Invoice --}}
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="p-8 text-white" style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <i class="fas fa-dumbbell text-3xl"></i>
                        <h1 class="text-3xl font-black">ShadexGym</h1>
                    </div>
                    <p class="text-white text-opacity-80">Membership Management System</p>
                    <p class="text-white text-opacity-80 text-sm mt-1">Kampala, Uganda</p>
                </div>
                <div class="text-right">
                    <p class="text-white text-opacity-80 text-sm">Invoice Number</p>
                    <p class="text-3xl font-black">#{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-white text-opacity-80 text-sm mt-2">Date: {{ $payment->payment_date }}</p>
                </div>
            </div>
        </div>

        <div class="p-8">

            {{-- Member and Payment Info --}}
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Bill To</h3>
                    <p class="text-xl font-bold text-gray-800">{{ $payment->member->user->name }}</p>
                    <p class="text-gray-600">{{ $payment->member->user->email }}</p>
                    <p class="text-gray-600">{{ $payment->member->phone }}</p>
                    <p class="text-gray-600">{{ $payment->member->address }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Payment Details</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Method:</span>
                            <span class="font-semibold capitalize">{{ $payment->payment_method }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Payment Date:</span>
                            <span class="font-semibold">{{ $payment->payment_date }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' :
                                   ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Invoice Table --}}
            <table class="w-full mb-8">
                <thead>
                    <tr style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                        <th class="text-left text-white px-6 py-3 rounded-tl-lg">Description</th>
                        <th class="text-left text-white px-6 py-3">Duration</th>
                        <th class="text-left text-white px-6 py-3">Start Date</th>
                        <th class="text-left text-white px-6 py-3">End Date</th>
                        <th class="text-right text-white px-6 py-3 rounded-tr-lg">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $payment->membershipPlan->name }}</p>
                            <p class="text-gray-500 text-sm">{{ $payment->membershipPlan->description }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $payment->membershipPlan->duration_days }} days</td>
                        <td class="px-6 py-4 text-gray-600">{{ $payment->start_date }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $payment->end_date }}</td>
                        <td class="px-6 py-4 text-right font-bold text-gray-800">
                            UGX {{ number_format($payment->amount, 0) }}
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Total --}}
            <div class="flex justify-end mb-8">
                <div class="w-64">
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">UGX {{ number_format($payment->amount, 0) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600">Tax (0%)</span>
                        <span class="font-semibold">UGX 0</span>
                    </div>
                    <div class="flex justify-between py-3 mt-2 rounded-lg px-3"
                         style="background: linear-gradient(135deg, #FF6B35, #FF1493)">
                        <span class="text-white font-bold text-lg">Total</span>
                        <span class="text-white font-black text-lg">UGX {{ number_format($payment->amount, 0) }}</span>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="border-t border-gray-200 pt-6 text-center">
                <p class="text-gray-500 text-sm">Thank you for choosing ShadexGym!</p>
                <p class="text-gray-400 text-xs mt-1">This is an official receipt. Please keep it for your records.</p>
                <div class="flex items-center justify-center mt-4 space-x-2">
                    <i class="fas fa-dumbbell" style="color: #FF6B35"></i>
                    <span class="font-bold" style="color: #FF6B35">ShadexGym</span>
                    <span class="text-gray-400">— Membership Management System</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>