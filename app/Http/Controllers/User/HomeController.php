<?php

namespace App\Http\Controllers\User;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $hotels = Hotel::select('hotel.*', \DB::raw('SUM(fasilitas.score) AS total_score'))
                ->join('fasilitas_hotel', 'fasilitas_hotel.hotel_id', '=', 'hotel.id')
                ->join('fasilitas', 'fasilitas.id', '=', 'fasilitas_hotel.fasilitas_id')
                ->groupBy('hotel.id')
                ->orderBy('hotel.harga_sewa', 'asc')
                ->orderBy('hotel.kelas_hotel', 'desc')
                ->orderBy('total_score', 'desc')
                ->orderBy('hotel.pelayanan', 'desc')
                ->orderBy('hotel.jarak', 'asc')->limit(10)
                ->get();
                foreach ($hotels as $hotel) {
                    $rating_pelayanan = round($hotel->pelayanan / 2);
                    $hotel->rating_pelayanan = $rating_pelayanan;
                }
        return view('user.index', compact('hotels'));
    }
}
