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
  $formattedEndDate = $end ? $endDate->translatedFormat($format) : 'Presente';

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

function sluggify($string)
{
  return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

function highlightables($string = "")
{
  $collections = [
    ["PHP", "Laravel", "Wordpress", "Livewire"],
    ["Ruby", "Ruby on Rails"],
    ["SQL", "MySQL", "PostgreSQL"],
    ["SCSS", "CSS", "Bootstrap"],
    ["Javascript", "Directus CMS", "JQuery", "Vue", "Alpine"],
    ["Typescript", "Angular"],
  ];

  // Convert items to their sluggified versions
  $collections = array_map(function ($items) {
    return array_map(fn($item) => sluggify($item), $items);
  }, $collections);

  // Sluggify the search string
  $sluggifiedString = sluggify($string);

  // Search for the collection containing the sluggified string
  foreach ($collections as $collection) {
    if (in_array($sluggifiedString, $collection)) {
      return json_encode($collection);
    }
  }

  // Return null if no match is found
  return json_encode([]);
}