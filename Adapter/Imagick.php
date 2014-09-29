<?php

namespace Gregwar\Image\Adapter;

use Gregwar\Image\Image;

/**
 * TODO:
 *  - When png transparent background is converted to jpeg, background becomes black (white for GD)
 */
class Imagick extends Common
{
    /**
     * @var \Imagick
     */
    protected $resource;

    /** @var int */
    protected $imagickBrightnessMax = 15;

    public function __construct()
    {
        parent::__construct();

        if (!(extension_loaded('imagick'))) {
            throw new \RuntimeException('You need to install Imagick PHP Extension to use this library');
        }
    }

	/**
	 * Gets the name of the adapter
	 *
	 * @return string
	 */
	public function getName()
    {
		return 'ImageMagick';
	}

    /**
     * @inheritdoc
     */
    public function width()
    {
        if (null === $this->resource) {
            $this->init();
        }

        return $this->resource->getImageWidth();
    }

    /**
     * @inheritdoc
     */
    public function height()
    {
        if (null === $this->resource) {
            $this->init();
        }

        return $this->resource->getImageHeight();
    }

	/**
	 * Save the image as a gif
	 *
	 * @return $this
	 */
	public function saveGif($file)
    {
        $this->resource->setImageFormat('gif');
        $this->resource->writeImage($file);

        return $this;
	}

	/**
	 * Save the image as a png
	 *
	 * @return $this
	 */
	public function savePng($file)
    {
        $this->resource->setImageFormat('png');
        $this->resource->writeImage($file);

        return $this;
	}

	/**
	 * Save the image as a jpeg
	 *
	 * @return $this
	 */
	public function saveJpeg($file, $quality)
    {
        $this->resource->setImageFormat('jpeg');
        $this->resource->setImageCompression(\Imagick::COMPRESSION_JPEG);
		$this->resource->setCompressionQuality($quality);
        $this->resource->writeImage($file);

        return $this;
	}

	/**
	 * Crops the image
	 *
	 * @param int $x the top-left x position of the crop box
	 * @param int $y the top-left y position of the crop box
	 * @param int $width the width of the crop box
	 * @param int $height the height of the crop box
	 *
	 * @return $this
	 */
	public function crop($x, $y, $width, $height)
    {
        $this->resource->cropImage($width, $height, $x, $y);

        return $this;
	}

	/**
	 * Fills the image background to $bg if the image is transparent
	 *
	 * @param int $background background color
	 *
	 * @return $this
	 */
	public function fillBackground($background = 0xffffff)
    {
        $this->resource->setImageBackgroundColor(new \ImagickPixel($background));
        $this->resource = $this->resource->flattenImages();

        return $this;
	}

	/**
	 * Negates the image
	 *
	 * @return $this
	 */
	public function negate()
    {
        $this->resource->setImageAlphaChannel(\Imagick::ALPHACHANNEL_DEACTIVATE);
		$this->resource->negateImage(false, \Imagick::CHANNEL_ALL);

        return $this;
	}

	/**
     * TODO: this method is not optimal.
     *
	 * Changes the brightness of the image
	 *
	 * @param int $brightness the brightness
	 *
	 * @return $this
	 */
	public function brightness($brightness)
    {
        if (abs($brightness) > 255 || $brightness == 0) {
            return $this;
        }

        $imagickBrightness = abs($brightness) / $this->brightnessMax * $this->imagickBrightnessMax;
        if ($imagickBrightness < 1) {
            $imagickBrightness = 1;
        }

        if ($brightness < 0) {
            $this->resource->evaluateImage(\Imagick::EVALUATE_DIVIDE, $imagickBrightness);
        } else {
            $this->resource->evaluateImage(\Imagick::EVALUATE_MULTIPLY, $imagickBrightness);
        }

        return $this;
	}

	/**
	 * Contrasts the image
	 *
	 * @param int $contrast the contrast [-100, 100]
	 *
	 * @return $this
	 */
	public function contrast($contrast)
    {
		// TODO: Implement contrast() method.

        return $this;
	}

	/**
	 * Apply a grayscale level effect on the image
	 *
	 * @return $this
	 */
	public function grayscale()
    {
		// TODO: Implement grayscale() method.

        return $this;
	}

	/**
	 * Emboss the image
	 *
	 * @return $this
	 */
	public function emboss(){
		// TODO: Implement emboss() method.

        return $this;
	}

	/**
	 * Smooth the image
	 *
	 * @param int $p value between [-10,10]
	 *
	 * @return $this
	 */
	public function smooth($p)
    {
		// TODO: Implement smooth() method.

        return $this;
	}

	/**
	 * Sharps the image
	 *
	 * @return $this
	 */
	public function sharp()
    {
		// TODO: Implement sharp() method.
	}

	/**
	 * Edges the image
	 *
	 * @return $this
	 */
	public function edge()
    {
		// TODO: Implement edge() method.

        return $this;
	}

	/**
	 * Colorize the image
	 *
	 * @param int $red value in range [-255, 255]
	 * @param int $green value in range [-255, 255]
	 * @param int $blue value in range [-255, 255]
	 *
	 * @return $this
	 */
	public function colorize($red, $green, $blue)
    {
		// TODO: Implement colorize() method.

        return $this;
	}

	/**
	 * apply sepia to the image
	 *
	 * @return $this
	 */
	public function sepia()
    {
		// TODO: Implement sepia() method.

        return $this;
	}

	/**
	 * Merge with another image
	 *
	 * @param Image $other
	 * @param int $x
	 * @param int $y
	 * @param int $width
	 * @param int $height
	 *
	 * @return $this
	 */
	public function merge(Image $other, $x = 0, $y = 0, $width = null, $height = null)
    {
		// TODO: Implement merge() method.

        return $this;
	}

	/**
	 * Rotate the image
	 *
	 * @param float $angle
	 * @param int $background
	 *
	 * @return $this
	 */
	public function rotate($angle, $background = 0xffffff)
    {
		// TODO: Implement rotate() method.

        return $this;
	}

	/**
	 * Fills the image
	 *
	 * @param int $color
	 * @param int $x
	 * @param int $y
	 *
	 * @return $this
	 */
	public function fill($color = 0xffffff, $x = 0, $y = 0)
    {
		// TODO: Implement fill() method.

        return $this;
	}

	/**
	 * write text to the image
	 *
	 * @param string $font
	 * @param string $text
	 * @param int $x
	 * @param int $y
	 * @param int $size
	 * @param int $angle
	 * @param int $color
	 * @param string $align
	 */
	public function write($font, $text, $x = 0, $y = 0, $size = 12, $angle = 0, $color = 0x000000, $align = 'left')
    {
		// TODO: Implement write() method.

        return $this;
	}

	/**
	 * Draws a rectangle
	 *
	 * @param int $x1
	 * @param int $y1
	 * @param int $x2
	 * @param int $y2
	 * @param int $color
	 * @param bool $filled
	 *
	 * @return $this
	 */
	public function rectangle($x1, $y1, $x2, $y2, $color, $filled = false)
    {
		// TODO: Implement rectangle() method.

        return $this;
	}

	/**
	 * Draws a rounded rectangle
	 *
	 * @param int $x1
	 * @param int $y1
	 * @param int $x2
	 * @param int $y2
	 * @param int $radius
	 * @param int $color
	 * @param bool $filled
	 *
	 * @return $this
	 */
	public function roundedRectangle($x1, $y1, $x2, $y2, $radius, $color, $filled = false)
    {
		// TODO: Implement roundedRectangle() method.

        return $this;
	}

	/**
	 * Draws a line
	 *
	 * @param int $x1
	 * @param int $y1
	 * @param int $x2
	 * @param int $y2
	 * @param int $color
	 *
	 * @return $this
	 */
	public function line($x1, $y1, $x2, $y2, $color = 0x000000)
    {
		// TODO: Implement line() method.

        return $this;
	}

	/**
	 * Draws an ellipse
	 *
	 * @param int $cx
	 * @param int $cy
	 * @param int $width
	 * @param int $height
	 * @param int $color
	 * @param bool $filled
	 *
	 * @return $this
	 */
	public function ellipse($cx, $cy, $width, $height, $color = 0x000000, $filled = false)
    {
		// TODO: Implement ellipse() method.

        return $this;
	}

	/**
	 * Draws a circle
	 *
	 * @param int $cx
	 * @param int $cy
	 * @param int $r
	 * @param int $color
	 * @param bool $filled
	 *
	 * @return $this
	 */
	public function circle($cx, $cy, $r, $color = 0x000000, $filled = false)
    {
		// TODO: Implement circle() method.

        return $this;
	}

	/**
	 * Draws a polygon
	 *
	 * @param array $points
	 * @param int $color
	 * @param bool $filled
	 *
	 * @return $this
	 */
	public function polygon(array $points, $color, $filled = false)
    {
		// TODO: Implement polygon() method.

        return $this;
	}

	/**
     *  @inheritdoc
     */
	public function flip($flipVertical, $flipHorizontal)
    {
		// TODO: Implement flip method

        return $this;
	}

	/**
	 * Creates an image
	 */
	protected function createImage($width, $height)
    {
		// TODO: Implement createImage() method.

        return $this;
	}

	/**
	 * Creating an image using $data
	 */
	protected function createImageFromData($data)
    {
        // TODO: Implement createImageFromData() method.
	}

    protected function loadFile($file, $type)
    {
        $this->resource = new \Imagick($file);

        return $this;
    }

	/**
	 * Resizes the image to an image having size of $target_width, $target_height, using
	 * $new_width and $new_height and padding with $bg color
	 */
	protected function doResize($bg, $target_width, $target_height, $new_width, $new_height)
    {
		// TODO: Implement doResize() method.

        return $this;
	}

	/**
	 * Gets the color of the $x, $y pixel
	 */
	protected function getColor($x, $y)
    {
		return $this->resource->getImagePixelColor($x, $y);
	}
}
