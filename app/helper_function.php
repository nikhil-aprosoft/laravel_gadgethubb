<?php

use App\Models\Product\Color;
use App\Models\Product\Size;
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
function colors()
{
    $colors = Color::all();
    return $colors;
}
function size()
{
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
function removeCurrency($value)
{
    return ((float) str_replace('₹', '', $value));
}
function generateStylishId()
{
    $prefix = 'GZ';

    $timestamp = substr(time(), -5);

    $randomString = getRandomString(4);

    return sprintf('%s-%s-%s', $prefix, $timestamp, $randomString);
}

function getRandomString($length)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
