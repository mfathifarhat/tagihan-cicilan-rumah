@extends('layout.app')
@section('title', 'Kwitansi - ' . $pembayaran->customer->nama)

@section('body')
    @php
        use App\Models\Tagihan;

        $count = 0;

        $cicilan = $pembayaran->customer->cicilan->id;

        $tagihans = Tagihan::where('cicilan_id', $cicilan)->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')->get();

        foreach ($tagihans as $item) {
            $count++;

            if ($item->id == $pembayaran->id) {
                break;
            }
        }
    @endphp


    <div class="buttons no-print border-bottom py-2 border-1 text-end px-2">
        <button id="printBtn" class="btn btn-primary px-4 fs-14">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
            </svg>

            <span class="ms-2">
                Cetak
            </span>

        </button>
    </div>
    <div class="container py-4">
        <div class="d-flex justify-content-between pb-4">
            <div class=" ">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td class="px-3">:</td>
                        <td>{{ $pembayaran->customer->nama }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="px-3">:</td>
                        <td>{{ $pembayaran->customer->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Kontak</td>
                        <td class="px-3">:</td>
                        <td>{{ $pembayaran->customer->no_hp }}</td>
                    </tr>
                </table>
            </div>
            <div class=" text-end">
                <h4 class="fw-bold">Kwitansi</h4>
                <p>Tanggal Cetak : {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </div>
        </div>

        <hr class="">
        <div class="row">
            <div class="col-3 ">
                <span class="fw-bold">Telah Menerima Dari</span>
            </div>
            <div class="col-9 ">
                <span>{{ $pembayaran->customer->nama }}</span>

                <hr>
            </div>
            <div class="col-3 ">
                <span class="fw-bold">Tanggal Bayar</span>
            </div>
            <div class="col-9 ">
                <span>{{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d-m-Y') }}</span>

                <hr>
            </div>
            <div class="col-3 ">
                <span class="fw-bold">Banyaknya Uang</span>
            </div>
            <div class="col-9 ">
                <span>{{ angkaKeTeks($pembayaran->nominal) . ' Rupiah' }}</span>

            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-3">
                <span class="fw-bold">Keterangan</span>
            </div>
            <div class="col-9">
                <span>{{ "Pembayaran cicilan ke $count" }}. Denda keterlambatan : Rp {{ number_format($pembayaran->denda * (($pembayaran->customer->cicilan->cicilan / 100) * 1), 0, ',', '.') }}</span>

                <hr>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-bold m-0">Jumlah : {{ number_format($pembayaran->nominal, 0, ',', '.') }}</h4>
            </div>
        </div>
        <hr>
        <div class="text-center fs-14 fw-medium">
            "Sesuai dengan ketentuan Management, kwitansi ini sah sehingga tidak diperlukan Tanda Tangan Basah & Stempel
            pada kwitansi ini"
        </div>
    </div>

@endsection
