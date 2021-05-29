<?php

function indoDate($date, $printDay = false, $datetime = false)
{
  $expl = explode(" ", $date);
  if (count($expl) > 1) {
    $time = explode(":", $expl[1])[0] . ':' . explode(":", $expl[1])[1];
  } else {
    $time = "";
  }
  $date = $expl[0];
  $day = [
    1 => 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'
  ];

  $month = [
    1 =>   'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
  ];
  $split     = explode('-', $date);
  $indoDate = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

  if ($printDay) {
    $num = date('N', strtotime($date));
    return $datetime ? $day[$num] . ', ' . $indoDate . ' ' . $time : $day[$num] . ', ' . $indoDate;
  }
  return $datetime ? $indoDate . ' ' . $time : $indoDate;
}

function timeDifferent($start, $finish)
{
  $diff = strtotime($finish) - strtotime($start);
  $hour = floor($diff / (60 * 60));
  $minute = floor($diff - $hour * (60 * 60)) / 60;
  return $hour . 'j ' . $minute . 'm';
}
