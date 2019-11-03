<?php

namespace App;

abstract class Image
{
    /**
     * Resource to loaded image.
     *
     * @property resource
     */
    protected $image;

    /**
     * Contain image atributes such a width, height, mimetype.
     *
     * @property array
     */
    protected $atributes;

    /**
     * Full path to image.
     *
     * @property string
     */
    protected $imagePath;

    public function __construct(string $imgPath)
    {
        $this->imagePath = $imgPath;
        $this->image     = $this->loadImage($imgPath);
        $this->atributes = getimagesize($imgPath);
    }

    /**
     * Static factory method, that create instatnce of Image child.
     *
     * @param string Full path to file.
     *
     * @return Image Instance of Image child class.
     *
     * @trow \Exception
     */
    final public static function load(string $imgPath): Image
    {
        $fileExtentions = self::getFileExtention($imgPath);
        if (!class_exists($imgclass = 'App\Image' . $fileExtentions)) {
            throw new \Exception("Can't support files with '{$fileExtentions}' extentions.");
        }

        return new $imgclass($imgPath);
    }

    /**
     * Resize image and render to browser
     *
     * @param int $height
     * @param int $width
     *
     * @return Image $this
     */
    public function resizeImg(int $width, int $height): Image
    {
        $image = $this->image;
        if ($width !== $this->atributes[0] && $height !== $this->atributes[1]) {
            $image = imagecreatetruecolor($width, $height);
            imagecopyresized($image, $this->image, 0, 0, 0, 0, $width, $height, $this->atributes[0], $this->atributes[1]);
            $this->image = $image;
        }

        return $this;
    }

    /**
     * Output Image to the browser.
     *
     * @return bool
     */
    public function render(): bool
    {
        header("Content-type: {$this->atributes['mime']}");

        return $this->renderImage($this->image);
    }

    /**
     * Return file extentions.
     *
     * @param string $imgPath
     *
     * @return string
     *
     * @trow \Exception
     */
    final public static function getFileExtention($imgPath): string
    {
        if (!file_exists($imgPath)) {
            throw new \Exception("Can't find a file in {$imgPath}");
        }

        return strtoupper(substr($imgPath, strrpos($imgPath, '.') + 1));
    }

    abstract protected function loadImage(string $imgPath);

    abstract protected function renderImage($image): bool;
}
