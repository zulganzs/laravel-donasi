<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Campaign;
use App\Models\Kategori;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    const title = 'We Care';

    public function index()
    {
        // Global Stats
        $total_dana = Transaksi::where('status_transaksi', 1)->sum('nominal_transaksi');
        $total_penerima = User::count(); 
        $program_aktif = Campaign::where('status_campaign', 1)->count();

        // Featured Campaigns (Limit 3)
        $featured_campaigns = Campaign::where('status_campaign', 1)->latest()->take(3)->get();

        // Latest Blogs (Limit 4)
        $latest_blogs = Blog::latest()->take(4)->get();

        // User Stats (only if logged in)
        $user = Auth::user();
        $user_donation_total = 0;
        $user_campaign_count = 0;

        if ($user) {
            $user_donation_total = Transaksi::where('user_id', $user->id)->where('status_transaksi', 1)->sum('nominal_transaksi');
            $user_campaign_count = Transaksi::where('user_id', $user->id)->where('status_transaksi', 1)->distinct('campaign_id')->count('campaign_id');
        }

        return view('dashboard.index', [
            'title' => 'We Care',
            'user' => $user,
            'total_dana' => $total_dana,
            'total_penerima' => $total_penerima,
            'program_aktif' => $program_aktif,
            'user_donation_total' => $user_donation_total,
            'user_campaign_count' => $user_campaign_count,
            'featured_campaigns' => $featured_campaigns,
            'latest_blogs' => $latest_blogs,
        ]);
    }

    public function kategori($kategori)
    {
        if($kategori == 'pendidikan'){
            $kat = 1;
        }elseif($kategori == 'sosial'){
            $kat = 2;
        }elseif($kategori == 'kesehatan'){
            $kat = 3;
        }
        $campaign = Campaign::where('category_id', $kat)->where('status_campaign', 1)->orderBy('tgl_akhir_campaign', 'asc')->paginate(6);
        return view('landing.kategori', [
            'campaign' => $campaign,
            'kat' => $kat,
            'title' => 'We Care',
        ]);
    }

    public function cari(Request $request)
    {
        if (!$request->has('filter')) {
            return redirect('/');
        }
        $cari = $request->input('filter');
        $results = Campaign::where('status_campaign', 1)->where('judul_campaign', 'like', "%{$cari}%")->get();

        return response()->json($results);
    }
}
