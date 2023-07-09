<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\FasilitasHotel;
use App\Models\PelayananHotel;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Pelayanan;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.daftar_hotel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.daftar_hotel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_hotel' => 'required',
            'harga_sewa' => 'required',
            'fasilitas' => 'required',
            'pelayanan' => 'required',
            'jarak' => 'required',
            'kota' => 'required',
            'file' => 'required'
        ]);
        
        if(count(Fasilitas::all()) <= 0) {
            return redirect()->back()->with('Error', 'Maaf, Data Fasilitas/Pelayanan Belum Lengkap, Silahkan Tambahkan Data Fasilitas/Pelayanan');
        }
        $hotel = new Hotel();
        
        $hotel->nama_hotel = $request->nama_hotel;
        $hotel->harga_sewa = $request->harga_sewa;
        $hotel->kelas_hotel = $request->kelas_hotel;
        $hotel->pelayanan = $request->pelayanan;
        $hotel->jarak = $request->jarak;
        $hotel->kota = $request->kota;
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $newName = date('Y-m-d').'-'.$name;
            $file->move('images', $newName);
            $hotel->image = $newName;
        }
        
        if($hotel->save()) {
            if($request->fasilitas && $request->pelayanan) {
                foreach($request->fasilitas as $fasilitas) {
                    $fasilitas = FasilitasHotel::create([
                            'hotel_id' => $hotel->id,
                            'fasilitas_id' => $fasilitas
                        ]);
                }
                
            }
            return redirect()->route('admin.hotel.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);

        return view('admin.daftar_hotel.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'harga_sewa' => 'required',
            'fasilitas' => 'required',
            'pelayanan' => 'required',
            'jarak' => 'required',
            'kota' => 'required'
        ]);
        
        $hotel = Hotel::find($id);
        $hotel->nama_hotel = $request->nama_hotel;
        $hotel->harga_sewa = $request->harga_sewa;
        $hotel->kelas_hotel = $request->kelas_hotel;
        $hotel->pelayanan = $request->pelayanan;
        $hotel->jarak = $request->jarak;
        $hotel->kota = $request->kota;
        if($request->hasFile('file')) {
            File::delete('images/'.$hotel->image);
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $newName = date('Y-m-d').'-'.$name;
            $file->move('images', $newName);
            $hotel->image = $newName;
        }
        
        if($hotel->save()) {
            if($request->fasilitas) {
                // dd($hotel->id);die();
                foreach($request->fasilitas as $fasilitas) {
                    FasilitasHotel::where('hotel_id', $hotel->id)->where('fasilitas_id', $fasilitas)->delete();

                     FasilitasHotel::create([
                        'hotel_id' => $hotel->id,
                        'fasilitas_id' => $fasilitas
                    ]);

                }
                
            }
            return redirect()->route('admin.hotel.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if($hotel->delete()) {
            return redirect()->back();
        }
    }
}
