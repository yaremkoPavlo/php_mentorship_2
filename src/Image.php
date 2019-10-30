<?php

namespace App;

abstract class Image
{
    /**
     * @property resource Resource to loaded image.
     */
    protected $image;

    /**
     * @property array Contain atributes of image width.
     */
    protected $atributes;

    /**
     * @property string Fool path to image.
     */
    protected $imagePath;

    public function __construct(string $imgPath)
    {
        $this->imagePath = $imgPath;
        $this->image     = $this->loadImage($imgPath);
        $this->atributes = getimagesize($imgPath);
    }

    /**
     * @param string Path to file.
     *
     * @return Image Instance of Image
     */
    public static function load(string $imgPath): Image
    {
        $fileExtentions = self::getFileExtention($imgPath);
        if (class_exists($imgclass = 'App\Image' . $fileExtentions)) {
            return new $imgclass(WORKING_DIR . $imgPath);
        }
    }

    /**
     * Resize image and render to browser
     *
     * @param int $height
     * @param int $width
     *
     * @return bool
     */
    public function resizeImg(int $width, int $height): bool
    {
        $image = $this->image;
        if ($width !== $this->atributes[0] && $height !== $this->atributes[1]) {
            $image = imagecreatetruecolor($width, $height);
            imagecopyresized($image, $this->image, 0, 0, 0, 0, $width, $height, $this->atributes[0], $this->atributes[1]);
        }
            
        header("Content-type: {$this->atributes['mime']}");
        return $this->renderImage($image);
    }

    /**
     * Return file extentions.
     *
     * @param string $imgPath
     *
     * @return string
     */
    public static function getFileExtention($imgPath): string
    {
        return strtoupper(substr($imgPath, -3));
    }

    abstract protected function loadImage(string $imgPath);

    abstract protected function renderImage($image): bool;
}
