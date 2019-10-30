<?php

namespace App;

class ImageJPG extends Image
{
    protected function renderImage($image): bool
    {
        return imagejpeg($image);
    }

    protected function loadImage(string $imgPath)
    {
        return imagecreatefromjpeg($imgPath);
    }
}
