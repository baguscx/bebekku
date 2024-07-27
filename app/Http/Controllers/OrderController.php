<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Transaction::where('status', 'success')->orderBy('created_at', 'asc')->get();
        return view('order.index', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $user = $transaction->user;
        return view('order.show', compact('transaction', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function upload(Request $request, String $id) {
        $imageName = null; // Declare and initialize the $imageName variable

        if ($request->hasFile('bukti_pengiriman')) {
            $image = $request->file('bukti_pengiriman');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/bukti_pengiriman'), $imageName);
        }

        Transaction::where('id', $id)->update([
            'bukti_pengiriman' => $imageName,
        ]);

        return redirect()->back();
    }

    public function faktur(String $id) {
        $transaction = Transaction::find($id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('order.faktur', compact('transaction'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('order.faktur', ['Attachment' => false]);
    }
}
