<?php

use Illuminate\Support\Str;
use App\Models\Product\Size;
use App\Models\Product\Color;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
    $cleanValue = preg_replace('/[^\d.]+/', '', $value);
    return (float) $cleanValue;
}
function generateStylishId()
{
    $prefix = strtoupper(Str::random(2)); 
    $timestamp = base_convert(microtime(true) * 10000, 10, 36); 
    $randomString = Str::random(6);

    return sprintf('%s-%s-%s', $prefix, $timestamp, strtoupper($randomString));
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

function cart_total($cartItems) {
    $total = $cartItems->sum(function ($item) {
      
        $price = removeCurrency($item->product->price);
        $subtotal = $price * $item->quantity;

        return $subtotal;
    });

    return $total;
}
