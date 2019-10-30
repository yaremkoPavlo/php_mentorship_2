<?php

namespace App;

class ImagePNG extends Image
{
    protected function renderImage( $image): bool
    {
        return imagepng($image);
    }

    protected function loadImage(string $imgPath)
    {
        return imagecreatefrompng($imgPath);
    }
}
