<div class="text-black">
    <h2 class="text-2xl font-semibold px-3">{{ $jabatan->nama }}</h2>
    <p class="px-3 text-justify text-sm">PT Usaha Mulia Digital <br> Jl. Gandaria Raya No.24-H, Jagakarsa, Kec.
        Jagakarsa, Kota Jakarta Selatan, Daerah
        Khusus Ibukota Jakarta 12620
    </p>
    <button type="button"
        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ml-3 mt-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"><a
            href="/lamar">Melamar</a></button>
    <h4 class="text-sm px-3 mt-3">Periode Lamaran</h4>
    <h5 class="px-3 text-sm">{{ \Carbon\Carbon::parse($lowonganPekerjaan->tanggal_mulai)->format('d-m-Y') }}
        -
        {{ \Carbon\Carbon::parse($lowonganPekerjaan->tanggal_akhir)->format('d-m-Y') }}</h5>
    <h4 class="text-sm px-3 mt-3">Kuota Lamaran</h4>
    <h5 class="px-3 text-sm">{{ $lowonganPekerjaan->kuota }}</h5>
    <h4 class="text-sm px-3 mt-3">Kisaran Gaji</h4>
    <h5 class="px-3 text-sm">{{ $jabatan->gaji }}</h5>

    <h4 class="font-semibold px-3 mt-5">Deskripsi Pekerjaan</h4>
    <h5 class="px-3 text-justify mt-2">{{ $jabatan->deskripsi }}</h5>
    <h4 class="font-semibold px-3 mt-5">Kriteria</h4>
    <h5 class="px-3 text-justify mt-2">{{  $jabatan->kriteria  }}</h5>
</div>