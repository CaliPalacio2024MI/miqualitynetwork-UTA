<?php

namespace App\Core\Traits;

trait DateTime
{
  // Add your methods here
  public function convertToHoursMins($time, $format = '%02d:%02d:%02d')
  {
      if ($time < 1) {
          return '00:00:00';
      }
      $hours = floor($time / 3600);
      $minutes = floor(($time % 3600) / 60);
      $seconds = $time % 60;
      return sprintf($format, $hours, $minutes, $seconds);
  }
}