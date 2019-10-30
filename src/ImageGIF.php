<?php

namespace App;

class ImageGIF extends Image
{
    protected function renderImage( $image): bool
    {
        return imagegif($image);
    }

    protected function loadImage(string $imgPath)
    {
        return imagecreatefromgif($imgPath);
    }
}
