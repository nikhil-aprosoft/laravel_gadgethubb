<?php

use App\Models\Product\Size;
use App\Models\Product\Color;
use Illuminate\Support\Carbon;

function getDealExpireTime($obj)
{ 
    $startTime = $obj->created_at; 
    $endTime = $obj->end_time; 

    $timestamp1 = Carbon::parse($startTime);
    $timestamp2 = Carbon::parse($endTime);

    $diffInSeconds = $timestamp2->diffInSeconds($timestamp1);

    $hours = floor($diffInSeconds / 3600);
    $remainingSeconds = $diffInSeconds % 3600;
    $minutes = floor($remainingSeconds / 60);
    $seconds = $remainingSeconds % 60;

    return "{$hours}: {$minutes}: {$seconds}";

}
function colors(){
    $colors = Color::all();
    return $colors;
}
function size(){
    $sizes = Size::all();     
    return $sizes;
}
 function cleanText($text)
{
    $text = str_replace('|', '', $text);

    // Replace multiple spaces with a single space
    $cleanedText = preg_replace('/\s+/', ' ', $text);
    
    // Trim any leading or trailing spaces
    $cleanedText = trim($cleanedText);
    
    return $cleanedText;
}
