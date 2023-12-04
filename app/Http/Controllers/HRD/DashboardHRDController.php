<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelamar;
use Illuminate\Support\Facades\DB;

class DashboardHRDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // #1. Chart Peserta Tiap bulan pada tahun ini
        $currentYear = Carbon::now()->year;
        // Buat array yang berisi nama-nama bulan dalam bahasa Indonesia:
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $pelamarPerBulan = Pelamar::whereYear('created_at', $currentYear)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get();

        $totalPesertaPerBulan = array_fill(1, 12, 0);

        foreach ($pelamarPerBulan as $item) {
            $totalPesertaPerBulan[$item->month] = $item->count;
        }

        $chartDataPesertaTahunIni = [];

        foreach ($namaBulan as $indexBulan => $bulanName) {
            $chartDataPesertaTahunIni[] = [
                'bulan' => $bulanName,
                'count' => $totalPesertaPerBulan[$indexBulan]
            ];
        }

        #2. Chart Pelamar Proses Seleksi
        


        return view('pages/dashboard/dashboard-hrd', ['title' => 'Dashboard'], compact('currentYear' ,'chartDataPesertaTahunIni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
