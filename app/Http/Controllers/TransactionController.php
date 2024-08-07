<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        if($request->quantity > $product->stock) {
            Alert::error('Error', 'Quantity exceeds the available stock');
            return redirect()->back();
        }
        $total = $request->quantity * $request->price;
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $total,
            'status' => 'pending',
        ]);

        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
                'address' => Auth::user()->address,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->save();

        Alert::success('Success', 'Product successfully purchased');
        return redirect()->route('transaction', $transaction->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $user = Auth::user();
        return view('buyer.checkout', compact( 'transaction', 'user', ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function success(Transaction $transaction)
    {
        $transaction->status = 'success';
        $transaction->save();

        $product = Product::find($transaction->product_id);
        $product->stock = $product->stock - $transaction->quantity;
        $product->save();

        $user = User::where('id', $transaction->user_id)->first();
        $mailData = [
            'title' => 'Thank you for your purchase',
            'body' => 'Your purchase has been successfully processed',
            'product' => $product,
            'transaction' => $transaction,
        ];

        Mail::to($user->email)->send(new SendEmail($mailData));
        Mail::to('barkedt@gmail.com')->send(new SendEmail($mailData));
        Mail::to('alippalevi7@gmail.com')->send(new SendEmail($mailData));

        return view('buyer.success', compact('transaction'));
    }

    public function laporan(){
        $transactions = Transaction::where('status', 'success')->get();
        $pdf = new Dompdf();
        $pdf->loadHtml(view('laporan', compact('transactions'))->render());
        $pdf->setPaper('A4', 'potrait');
        $pdf->render();
        $pdf->stream('laporan', ['Attachment' => false]);
    }

    public function mail(){
                $mailData = [
            'title' => 'Thank you for your purchase',
            'body' => 'Your purchase has been successfully processed',
            // 'product' => $product,
            // 'transaction' => $transaction,
        ];

        Mail::to('bebekku@gmail.com')->send(new SendEmail($mailData));
        Mail::to('barkedt@gmail.com')->send(new SendEmail($mailData));

    }
}
