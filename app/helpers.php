<?php

function format_uang($uang)
{
    if ($uang > 1000 && $uang < 1000000) {
        return 'Rp ' . number_format($uang / 1000) . ' Ribu';
    } elseif ($uang < 1000000000 && $uang > 1000) {
        return 'Rp ' . number_format($uang / 1000000, 2) . ' Juta';
    } else {
        return 'Rp ' . number_format($uang / 1000000000, 2) . ' Miliar';
    }
}


function bulan($date)
{
    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember',
    ];

    $englishMonth = date('F', strtotime($date));
    $indonesianMonth = $months[$englishMonth];

    return $indonesianMonth . date_format(date_create($date), ' Y');
}

function bulan_only($date)
{
    $months = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    $englishMonth = $date;
    $indonesianMonth = $months[$englishMonth];

    return $indonesianMonth;
}

function angkaKeTeks($angka)
{
    $satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
    if ($angka < 12) {
        return $satuan[$angka];
    } elseif ($angka < 20) {
        return $satuan[$angka - 10] . ' Belas';
    } elseif ($angka < 100) {
        return angkaKeTeks(intval($angka / 10)) . ' Puluh ' . angkaKeTeks($angka % 10);
    } elseif ($angka < 200) {
        return 'Seratus ' . angkaKeTeks($angka - 100);
    } elseif ($angka < 1000) {
        return angkaKeTeks(intval($angka / 100)) . ' Ratus ' . angkaKeTeks($angka % 100);
    } elseif ($angka < 2000) {
        return 'Seribu ' . angkaKeTeks($angka - 1000);
    } elseif ($angka < 1000000) {
        return angkaKeTeks(intval($angka / 1000)) . ' Ribu ' . angkaKeTeks($angka % 1000);
    } elseif ($angka < 1000000000) {
        return angkaKeTeks(intval($angka / 1000000)) . ' Juta ' . angkaKeTeks($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        return angkaKeTeks(intval($angka / 1000000000)) . ' Miliar ' . angkaKeTeks($angka % 1000000000);
    } else {
        return angkaKeTeks(intval($angka / 1000000000000)) . ' Triliun ' . angkaKeTeks($angka % 1000000000000);
    }
}