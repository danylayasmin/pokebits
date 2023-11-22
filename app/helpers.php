<?php

use Intervention\Image\ImageManagerStatic as Image;

function getAverageColorFromImageUrl($imageUrl): string
{
    if (empty($imageUrl)) {
        return '#000000';
    }

    $img = Image::make($imageUrl);

    $img->resize(14, 14);

    $totalR = 0;
    $totalG = 0;
    $totalB = 0;

    $width = $img->width();
    $height = $img->height();

    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $color = $img->pickColor($x, $y);
            $totalR += $color[0];
            $totalG += $color[1];
            $totalB += $color[2];
        }
    }

    $pixelCount = $width * $height;
    $avgR = $totalR / $pixelCount;
    $avgG = $totalG / $pixelCount;
    $avgB = $totalB / $pixelCount;

    return sprintf("#%02x%02x%02x", $avgR, $avgG, $avgB);
}

function errorJson($message, $code = 400)
{
    return response()->json([
        'message' => $message,
        'error_code' => $code,
    ], $code);
}
