<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'cicilan_id',
        'status',
        'tgl_bayar',
        'denda',
        'bulan',
        'tahun',
    ];

    public function bayar()
    {
        return $this->hasMany(Pembayaran::class, 'tagihan_id');
    }

    public function bayarBerhasil()
    {
        return $this->hasOne(Pembayaran::class)->where('status', 'Berhasil');
    }

    public function cicilan()
    {
        return $this->belongsTo(Cicilan::class, 'cicilan_id');
    }


    // public static function create_tagihan()
    // {
    //     $cicilans = Cicilan::where('status', 'Belum Lunas')->get();
    //     $today = Carbon::today();

    //     $bulan = $today->format('m');
    //     $tahun = $today->format('Y');

    //     $currentMonth = Carbon::now()->month;
    //     $currentYear = Carbon::now()->year;

    //     foreach ($cicilans as $item) {
    //         $isSameMonth = Carbon::parse($item->created_at)->isSameMonth(Carbon::now());


    //         if ($today->day > 10) {
    //             $existingTagihan = Tagihan::where('cicilan_id', $item->id)
    //                 ->where('bulan', $today->copy()->addMonth()->format('m'))
    //                 ->where('tahun', $tahun)
    //                 ->exists();

    //             if(!$existingTagihan){
    //                 Tagihan::create([
    //                     'cicilan_id' => $item->id,
    //                     'bulan' => $today->copy()->addMonth()->format('m'),
    //                     'tahun' => $tahun,
    //                 ]);
    //             }
    //         }
    //     }
    // }

    public static function create_tagihan()
    {
        $cicilans = Cicilan::where('status', 'Belum Lunas')->get();
        $today = Carbon::today();

        $currentMonth = $today->month;
        $currentYear = $today->year;

        foreach ($cicilans as $item) {
            $cicilanCreatedAt = Carbon::parse($item->created_at);

            $lastTagihan = Tagihan::where('cicilan_id', $item->id)
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'desc')
                ->first();

            if ($lastTagihan) {
                $nextTagihanDate = Carbon::createFromDate($lastTagihan->tahun, $lastTagihan->bulan, 1)->addMonth();

                if ($today->day > 10) {
                    while ($nextTagihanDate->lessThanOrEqualTo($today->copy()->startOfMonth()->addMonth(2))  && ($item->tagihan->count() < ($item->jangka_waktu * 12))) {
                        $bulan = $nextTagihanDate->format('m');
                        $tahun = $nextTagihanDate->format('Y');
    
                        $existingTagihan = Tagihan::where('cicilan_id', $item->id)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->exists();
    
    
                        if ($item->tagihan->count() < ($item->jangka_waktu * 12)) {
                            if (!$existingTagihan) {
                                Tagihan::create([
                                    'cicilan_id' => $item->id,
                                    'bulan' => $bulan,
                                    'tahun' => $tahun,
                                ]);
                            }
                        }
    
                        // Move to the next month
                        $nextTagihanDate->addMonth();
                        $item->refresh();
                    }
                } else {
                    while ($nextTagihanDate->lessThanOrEqualTo($today->copy()->startOfMonth()->startOfMonth()) && ($item->tagihan->count() < ($item->jangka_waktu * 12))) {
                        $bulan = $nextTagihanDate->format('m');
                        $tahun = $nextTagihanDate->format('Y');
    
                        $existingTagihan = Tagihan::where('cicilan_id', $item->id)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->exists();
    
                        if ($item->tagihan->count() < ($item->jangka_waktu * 12)) {
                            if (!$existingTagihan) {
                                Tagihan::create([
                                    'cicilan_id' => $item->id,
                                    'bulan' => $bulan,
                                    'tahun' => $tahun,
                                ]);
                            }
                        }
    
                        // Move to the next month
                        $nextTagihanDate->addMonth();
                        $item->refresh();
                    }
                }
            } else {
                $nextTagihanDate = $cicilanCreatedAt->copy()->startOfMonth()->addMonth(1);

                if ($today->day > 10) {
                    while ($nextTagihanDate->lessThanOrEqualTo($today->copy()->startOfMonth()->addMonth(1))  && ($item->tagihan->count() < ($item->jangka_waktu * 12))) {
                        $bulan = $nextTagihanDate->format('m');
                        $tahun = $nextTagihanDate->format('Y');
    
                        $existingTagihan = Tagihan::where('cicilan_id', $item->id)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->exists();
    
    
                        if ($item->tagihan->count() < ($item->jangka_waktu * 12)) {
                            if (!$existingTagihan) {
                                Tagihan::create([
                                    'cicilan_id' => $item->id,
                                    'bulan' => $bulan,
                                    'tahun' => $tahun,
                                ]);
                            }
                        }
    
                        // Move to the next month
                        $nextTagihanDate->addMonth();
                        $item->refresh();
                    }
                } else {
                    while ($nextTagihanDate->lessThanOrEqualTo($today->copy()->startOfMonth()->startOfMonth()) && ($item->tagihan->count() < ($item->jangka_waktu * 12))) {
                        $bulan = $nextTagihanDate->format('m');
                        $tahun = $nextTagihanDate->format('Y');
    
                        $existingTagihan = Tagihan::where('cicilan_id', $item->id)
                            ->where('bulan', $bulan)
                            ->where('tahun', $tahun)
                            ->exists();
    
                        if ($item->tagihan->count() < ($item->jangka_waktu * 12)) {
                            if (!$existingTagihan) {
                                Tagihan::create([
                                    'cicilan_id' => $item->id,
                                    'bulan' => $bulan,
                                    'tahun' => $tahun,
                                ]);
                            }
                        }
    
                        // Move to the next month
                        $nextTagihanDate->addMonth();
                        $item->refresh();
                    }
                }
            }



            
        }
    }


    public static function send_monthly($phone, $customer)
    {
        $token = 'EZBLU_kFcfH+LLqtvjSA';
        $pesan = "Halo $customer, kami ingin mengingatkan bahwa 3 hari lagi adalah tanggal jatuh tempo kamu untuk membayar cicilan rumah kamu. Pastikan kamu membayar tepat waktu agar tidak terkena denda!";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $phone, 'message' => $pesan),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public static function send_monthly2($phone, $customer)
    {
        $token = 'EZBLU_kFcfH+LLqtvjSA';
        $pesan = "Halo $customer, kami ingin mengingatkan bahwa 7 hari lagi adalah tanggal jatuh tempo kamu untuk membayar cicilan rumah kamu. Pastikan kamu membayar tepat waktu agar tidak terkena denda!";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $phone, 'message' => $pesan),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public static function send_deadline($phone, $customer)
    {
        $token = 'EZBLU_kFcfH+LLqtvjSA';
        $pesan = "Halo $customer, kami ingin mengingatkan bahwa hari ini adalah tanggal jatuh tempo kamu untuk membayar cicilan rumah kamu. Pastikan kamu membayar tepat waktu agar tidak terkena denda!";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $phone, 'message' => $pesan),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public static function send_late($phone, $customer)
    {
        $token = 'EZBLU_kFcfH+LLqtvjSA';
        $pesan = "Halo $customer, kami ingin menginformasikan bahwa kamu telah telat membayar cicilan! Denda terlambat setiap harinya adalah 1% dari harga properti kamu. Jadi pastikan untuk segera membayar cicilan anda!";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $phone, 'message' => $pesan),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
