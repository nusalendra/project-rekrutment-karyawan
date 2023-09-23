<div class="text-black">
    <h2 class="text-2xl font-semibold px-3">{{ $jabatan->nama }}</h2>
    <p class="px-3 text-justify text-sm">PT Usaha Mulia Digital <br> Jl. Gandaria Raya No.24-H, Jagakarsa, Kec.
        Jagakarsa, Kota Jakarta Selatan, Daerah
        Khusus Ibukota Jakarta 12620
    </p>
    <div class="mr-2 mb-2 ml-3 mt-3 py-3">
        @if ($statusLamaran == 'Ditolak')
            <button type="button"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                @disabled(true)>Lamaran Ditolak</button>
        @elseif($statusLamaran == 'Disetujui')
            <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                @disabled(true)>Lamaran Disetujui</button>
        @elseif($statusLamaran == 'Proses')
            <button type="button"
                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"
                @disabled(true)>Lamaran Diproses</button>
        @else
            @php
                $lowonganPekerjaanIdEncrypt = Crypt::encrypt($lowonganPekerjaan->id);
            @endphp
            <a href="/lamar/{{ $lowonganPekerjaanIdEncrypt }}"
                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Melamar</a>
        @endif
    </div>
    <h4 class="text-sm px-3 mt-3">Periode Lamaran</h4>
    <h5 class="px-3 text-sm">{{ \Carbon\Carbon::parse($lowonganPekerjaan->tanggal_mulai)->format('d-m-Y') }}
        -
        {{ \Carbon\Carbon::parse($lowonganPekerjaan->tanggal_akhir)->format('d-m-Y') }}</h5>
    <h4 class="text-sm px-3 mt-3">Kuota Lamaran</h4>
    <h5 class="px-3 text-sm">{{ $lowonganPekerjaan->kuota }}</h5>
    <h4 class="text-sm px-3 mt-3">Kisaran Gaji</h4>
    <h5 class="px-3 text-sm">Rp. {{ number_format($jabatan->gaji_awal) }},- s/d Rp.
        {{ number_format($jabatan->gaji_akhir) }},-</h5>

    <h4 class="font-semibold px-3 mt-5">Deskripsi Pekerjaan</h4>
    <h5 class="px-3 text-justify mt-2">{!! $jabatan->deskripsi !!}</h5>
    <h4 class="font-semibold px-3 mt-5">Benefit Pekerjaan</h4>
    <h5 class="px-3 text-justify mt-2">{!! $jabatan->benefit_pekerjaan !!}</h5>
    <h4 class="font-semibold px-3 mt-5">Kriteria</h4>
    <h5 class="px-3 text-justify mt-2">{!! $jabatan->kriteria !!}</h5>
</div>
