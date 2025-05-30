<?php 
    if (!function_exists('list_bulan')) {
        function list_bulan()
        {
            $bln = array(
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
                '12' => 'Desember'
                );

            return $bln;
        }
    }

    if (!function_exists('date_format_indonesia')) {
        function date_format_indonesia($date)
        {
            $months = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];

            $dateParts = explode('-', $date);
            $year = $dateParts[0];
            $month = $months[$dateParts[1]];
            $day = $dateParts[2];

            return $day . ' ' . $month . ' ' . $year;
        }
    }

?>