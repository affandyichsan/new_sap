<?php
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
        @$size[$factor];
}
function indonesian_date2($timestamp = '', $date_format = 'j F Y h:i:s A')
{
    if (trim($timestamp) == '') {
        $timestamp = time();
    } elseif (!ctype_digit($timestamp)) {
        $timestamp = strtotime($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace("/S/", "", $date_format);
    $pattern = array(
        '/Mon[^day]/',
        '/Tue[^sday]/',
        '/Wed[^nesday]/',
        '/Thu[^rsday]/',
        '/Fri[^day]/',
        '/Sat[^urday]/',
        '/Sun[^day]/',
        '/Monday/',
        '/Tuesday/',
        '/Wednesday/',
        '/Thursday/',
        '/Friday/',
        '/Saturday/',
        '/Sunday/',
        '/Jan[^uary]/',
        '/Feb[^ruary]/',
        '/Mar[^ch]/',
        '/Apr[^il]/',
        '/May/',
        '/Jun[^e]/',
        '/Jul[^y]/',
        '/Aug[^ust]/',
        '/Sep[^tember]/',
        '/Oct[^ober]/',
        '/Nov[^ember]/',
        '/Dec[^ember]/',
        '/January/',
        '/February/',
        '/March/',
        '/April/',
        '/June/',
        '/July/',
        '/August/',
        '/September/',
        '/October/',
        '/November/',
        '/December/',
    );
    $replace = array(
        'Sen',
        'Sel',
        'Rab',
        'Kam',
        'Jum',
        'Sab',
        'Min',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Ags',
        'Sep',
        'Okt',
        'Nov',
        'Des',
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    );
    $date = date($date_format, $timestamp);
    $date = preg_replace($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
}
function indonesian_date($timestamp = '', $date_format = 'j F Y')
{
    if (trim($timestamp) == '') {
        $timestamp = time();
    } elseif (!ctype_digit($timestamp)) {
        $timestamp = strtotime($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace("/S/", "", $date_format);
    $pattern = array(
        '/Mon[^day]/',
        '/Tue[^sday]/',
        '/Wed[^nesday]/',
        '/Thu[^rsday]/',
        '/Fri[^day]/',
        '/Sat[^urday]/',
        '/Sun[^day]/',
        '/Monday/',
        '/Tuesday/',
        '/Wednesday/',
        '/Thursday/',
        '/Friday/',
        '/Saturday/',
        '/Sunday/',
        '/Jan[^uary]/',
        '/Feb[^ruary]/',
        '/Mar[^ch]/',
        '/Apr[^il]/',
        '/May/',
        '/Jun[^e]/',
        '/Jul[^y]/',
        '/Aug[^ust]/',
        '/Sep[^tember]/',
        '/Oct[^ober]/',
        '/Nov[^ember]/',
        '/Dec[^ember]/',
        '/January/',
        '/February/',
        '/March/',
        '/April/',
        '/June/',
        '/July/',
        '/August/',
        '/September/',
        '/October/',
        '/November/',
        '/December/',
    );
    $replace = array(
        'Sen',
        'Sel',
        'Rab',
        'Kam',
        'Jum',
        'Sab',
        'Min',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu',
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Ags',
        'Sep',
        'Okt',
        'Nov',
        'Des',
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    );
    $date = date($date_format, $timestamp);
    $date = preg_replace($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
}
function numberToRomanRepresentation($number)
{
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if ($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
//dari service alat
function nomorHari($nohari)
{
    switch ($nohari) {
        case 1:
            return 'Senin';
            break;
        case 2:
            return 'Selasa';
            break;
        case 3:
            return 'Rabu';
            break;
        case 4:
            return 'Kamis';
            break;
        case 5:
            return 'Jum\'at';
            break;
        case 6:
            return 'Sabtu';
            break;
        case 7:
            return 'Minggu';
            break;
    }
}
//dari mysql
function getHari($nohari)
{
    switch ($nohari) {
        case 1:
            return 'Minggu';
            break;
        case 2:
            return 'Senin';
            break;
        case 3:
            return 'Selasa';
            break;
        case 4:
            return 'Rabu';
            break;
        case 5:
            return 'Kamis';
            break;
        case 6:
            return 'Jum\'at';
            break;
        case 7:
            return 'Sabtu';
            break;
    }
}
function getBulan($nobulan)
{
    switch ($nobulan) {
        case 1:
            return 'Januari ';
            break;
        case 2:
            return 'Februari';
            break;
        case 3:
            return 'Maret';
            break;
        case 4:
            return 'April';
            break;
        case 5:
            return 'Mei';
            break;
        case 6:
            return 'Juni';
            break;
        case 7:
            return 'Juli';
            break;
        case 8:
            return 'Agustus';
            break;
        case 9:
            return 'September';
            break;
        case 10:
            return 'Oktober';
            break;
        case 11:
            return 'November';
            break;
        case 12:
            return 'Desember';
            break;
    }
}
function getMode($mode)
{
    switch ($mode) {
        case 1:
            return 'Multiplan';
            break;
        case 2:
            return 'Adaptif';
            break;
    }
}
function getDay($date)
{
    $day = date('D', strtotime($date));
    switch ($day) {
        case 'Sun':
            return "Minggu";
            break;

        case 'Mon':
            return "Senin";
            break;

        case 'Tue':
            return "Selasa";
            break;

        case 'Wed':
            return "Rabu";
            break;

        case 'Thu':
            return "Kamis";
            break;

        case 'Fri':
            return "Jumat";
            break;

        case 'Sat':
            return "Sabtu";
            break;
    }
}
function getMinggu($minggu, $bulan)
{
    $data = $minggu % $bulan;
    if ($data = 0) {
        return $data + 1;
    }
    if ($data = 5) {
        return $data - 1;
    } else {
        $data++;
    }
    return $data;
}

function convDateTime($datetime)
{
    // Format d-m-y H:i (2 digit tahun)
    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
    if ($dt !== false) {
        $day   = $dt->format('d');
        $month = $dt->format('m');
        $year  = (int)$dt->format('y'); // ambil 2 digit tahun
        $hour  = $dt->format('H');
        $min   = $dt->format('i');
        $sec   = $dt->format('s');

        // Asumsikan semua tahun 2 digit = abad 2000
        $year = 2000 + $year;

        return sprintf("%04d-%02d-%02d %02d:%02d:%02d", $year, $month, $day, $hour, $min, $sec);
    }

    // Format lain d-m-Y H:i:s
    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
    if ($dt !== false) {
        return $dt->format('Y-m-d H:i:s');
    }

    // Format lain d-m-Y H:i
    $dt = DateTime::createFromFormat('d-m-Y H:i:s', $datetime);
    if ($dt !== false) {
        return $dt->format('Y-m-d H:i:s');
    }

    // Format slash m/d/Y H:i
    if (strpos($datetime, '/') !== false) {
        $dt = DateTime::createFromFormat('m/d/Y H:i:s', $datetime);
        if ($dt !== false) {
            return $dt->format('Y-m-d H:i:s');
        }
    }

    // fallback
    $ts = strtotime($datetime);
    if ($ts !== false) {
        return date('Y-m-d H:i:s', $ts);
    }

    return null;
}
