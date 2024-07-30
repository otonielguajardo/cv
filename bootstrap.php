<?php

use TightenCo\Jigsaw\Jigsaw;

/** @var \Illuminate\Container\Container $container */
/** @var \TightenCo\Jigsaw\Events\EventBus $events */

require 'vendor/autoload.php';

use Carbon\Carbon;

Carbon::setLocale('es-MX');

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

function printDate($date, $format = 'd M Y')
{
  return Carbon::parse($date)->format($format);
}

function printDateRange($start, $end = null, $includeMonth = true)
{
  $startDate = Carbon::parse($start);
  $endDate = $end ? Carbon::parse($end) : Carbon::now();
  $format = $includeMonth ? 'M Y' : 'Y';

  $formattedStartDate = $startDate->translatedFormat($format);
  $formattedEndDate = $end ? $endDate->translatedFormat($format) : 'En curso';

  return "$formattedStartDate - $formattedEndDate";
}

function printDuration($start, $end = null, $includeMonths = true)
{
  $startDate = Carbon::parse($start);
  $endDate = $end ? Carbon::parse($end) : Carbon::now();

  $years = floor($startDate->diffInYears($endDate));
  $months = $startDate->diffInMonths($endDate) % 12;

  if ($years == 0 && $months == 0) {
    return "0 meses";
  }

  $duration = "";
  if ($years > 0) {
    $duration .= $years == 1 ? "$years año" : "$years años";
  }

  if ($includeMonths && $months > 0) {
    if ($years > 0) {
      $duration .= " y ";
    }
    $duration .= "$months meses";
  }

  return $duration;
}
