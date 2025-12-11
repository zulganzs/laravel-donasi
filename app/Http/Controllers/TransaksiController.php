<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Midtrans\Transaction;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $transaksi = Transaksi::with('user')->get();
        return view('admin.transaksi', [
            'title' => 'Transaksi - We Care',
            'transaksi' => $transaksi,
        ]);
    }

    public function mydonation()
    {
        $transaksi = Transaksi::with('campaign')->where('user_id', Auth::user()->id)->get();
        return view('landing.mydonasi', [
            'transaksi'  => $transaksi,
        ]);
    }


    public function create(Request $request, $id)
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $request->input('nominal'));
        if ($request->isMethod('post')) {
            $nama = $request->nama;
            if ($request->has('anonim')) {
                $nama = 'Orang Baik';
            }

            $transaksi = Transaksi::create([
                'user_id' => $request->user_id,
                'campaign_id' => $id,
                'nominal_transaksi' => $nominal,
                'nama' => $nama,
                'tgl_transaksi' => Carbon::now(),
                'keterangan' => empty($request->pesan) ? 'Doa dari Orang Baik' : $request->pesan,
                'status_transaksi' => 1, // Set to 1 (paid) for demo purposes
            ]);
            $transaksiId = $transaksi->id;

            // Update dana terkumpul for the campaign
            $campaign = Campaign::findOrFail($id);
            $campaign->dana_terkumpul += $nominal;
            $campaign->save();

            return redirect('/checkout/' . $transaksiId)->with('success', 'Donasi berhasil dilakukan');
        }
        return view('/');
    }

    public function checkout($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $campaign = Campaign::findOrFail($transaksi->campaign_id);
        $user = User::findOrFail($transaksi->user_id);
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Config::$serverKey = 'SB-Mid-server-mzlZbKG5pog43pNjc8xUVdxT';

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;

        // Set transaction's order_id. Must be unique.
        $orderId = $transaksi->id;

        // Set transaction's amount (required)
        $amount = $transaksi->nominal_transaksi + 5000;

        // Set transaction's customer details
        $customerDetails = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        // Initialize transaction parameter
        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => $customerDetails,
        ];

        // Create Snap Token transaction
 
        // Render checkout page with Snap Token
        // return view('checkout', compact('snapToken'));

        return view('landing.payment', [
            'transaksi' => $transaksi,
            'campaign' => $campaign,
        ]);
    }

    public function donateForm($slug)
    {
        $campaign = Campaign::where('slug_campaign', $slug)->firstOrFail();
        return view('landing.checkout', [
            'campaign' => $campaign,
        ]);
    }
}
