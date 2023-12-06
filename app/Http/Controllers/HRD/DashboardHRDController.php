<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pelamar;
use App\Models\Jabatan;
use App\Models\PelamarTesPotensiAkademik;
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

        $pelamarPerBulan = Pelamar::whereYear('pelamars.created_at', $currentYear)
            ->join('users', 'pelamars.user_id', '=', 'users.id') // Gantilah 'users' dengan nama tabel relasi user jika berbeda
            ->select(DB::raw('MONTH(pelamars.created_at) as month'), DB::raw('COUNT(DISTINCT pelamars.user_id) as count'))
            ->groupBy('month')
            ->get();

        $totalPelamarPerBulan = array_fill(1, 12, 0);

        foreach ($pelamarPerBulan as $item) {
            $totalPelamarPerBulan[$item->month] = $item->count;
        }

        $chartDataPelamarTahunIni = [];

        foreach ($namaBulan as $indexBulan => $bulanName) {
            $chartDataPelamarTahunIni[] = [
                'bulan' => $bulanName,
                'count' => $totalPelamarPerBulan[$indexBulan]
            ];
        }

        #2. Chart Jumlah Lamaran Pelamar di Setiap Posisi Jabatan
        $jabatan = Jabatan::all();

        $pelamarPekerjaan = $jabatan->map(function ($jabatan) {
            $totalPelamar = Pelamar::whereHas('lowonganPekerjaan', function ($query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id);
            })->count();

            return [
                'jabatan' => $jabatan->nama,
                'total_pelamar' => $totalPelamar,
            ];
        });

        #3. Chart Jumlah Pelamar Lolos Tahap Seleksi Pelamar
        $pelamarLolosSeleksi = $jabatan->map(function ($jabatan) {
            $statusLamaranArray = ['Tahap Tes Potensi Akademik', 'Tahap Tes Potensi Akademik Ditolak', 'Tahap Pengoreksian Tes Potensi Akademik', 'Pelamar Disetujui', 'Tahap Wawancara', 'Tahap Wawancara Ditolak'];
            $totalPelamarLolosSeleksi = Pelamar::whereHas('lowonganPekerjaan', function ($query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id);
            })->whereIn('status_lamaran', $statusLamaranArray)->count();

            return [
                'jabatan' => $jabatan->nama,
                'total_pelamar_lolos_seleksi' => $totalPelamarLolosSeleksi,
            ];
        });

        #4. Chart Jumlah pelamar yang mengikuti tes potensi akademik per posisi jabatan
        $pelamarTesPotensiAkademik = $jabatan->map(function ($jabatan) {
            $totalPelamarTesPotensiAkademik = PelamarTesPotensiAkademik::whereHas('tesPotensiAkademik.lowonganPekerjaan', function ($query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id);
            })->count();

            return [
                'jabatan' => $jabatan->nama,
                'total_pelamar_tes_potensi_akademik' => $totalPelamarTesPotensiAkademik,
            ];
        });

        #5. Chart Jumlah Pelamar Lolos Tahap Tes Potensi Akademik
        $pelamarLolosTesPotensiAkademik = $jabatan->map(function ($jabatan) {
            $statusLamaranPelamarLolosTesPotensiAkademikArray = ['Tahap Pengoreksian Tes Potensi Akademik', 'Pelamar Disetujui', 'Tahap Wawancara', 'Tahap Wawancara Ditolak'];
            $totalPelamarLolosTesPotensiAkademik = Pelamar::whereHas('lowonganPekerjaan', function ($query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id);
            })->whereIn('status_lamaran', $statusLamaranPelamarLolosTesPotensiAkademikArray)->count();

            return [
                'jabatan' => $jabatan->nama,
                'total_pelamar_lolos_tes_potensi_akademik' => $totalPelamarLolosTesPotensiAkademik,
            ];
        });

        #6. Chart Jumlah Pelamar yang mengikuti tes wawancara
        $pelamarTesWawancara = $jabatan->map(function ($jabatan) {
            $statusLamaranPelamarTesWawancaraArray = ['Pelamar Disetujui', 'Tahap Wawancara', 'Tahap Wawancara Ditolak'];
            $totalPelamarTesWawancara = Pelamar::whereHas('lowonganPekerjaan', function ($query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id);
            })->whereIn('status_lamaran', $statusLamaranPelamarTesWawancaraArray)->count();

            return [
                'jabatan' => $jabatan->nama,
                'total_pelamar_tes_wawancara' => $totalPelamarTesWawancara,
            ];
        });

        #7. Chart Jumlah Pelamar yang lolos tahap wawancara
        $pelamarLolosTesWawancara = $jabatan->map(function ($jabatan) {
            $statusLamaranPelamarLolosTesWawancaraArray = ['Pelamar Disetujui'];
            $totalPelamarLolosTesWawancara = Pelamar::whereHas('lowonganPekerjaan', function ($query) use ($jabatan) {
                $query->where('jabatan_id', $jabatan->id);
            })->whereIn('status_lamaran', $statusLamaranPelamarLolosTesWawancaraArray)->count();

            return [
                'jabatan' => $jabatan->nama,
                'total_pelamar_lolos_tes_wawancara' => $totalPelamarLolosTesWawancara,
            ];
        });

        return view('pages/dashboard/dashboard-hrd', ['title' => 'Dashboard'], compact('currentYear', 'chartDataPelamarTahunIni', 'pelamarPekerjaan', 'pelamarLolosSeleksi', 'pelamarTesPotensiAkademik', 'pelamarLolosTesPotensiAkademik', 'pelamarTesWawancara', 'pelamarLolosTesWawancara'));
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
