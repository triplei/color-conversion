<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace TripleI\ColorConversion;

class Color {
    protected $color;

    /**
     * Color constructor.
     *
     * @param string $color
     * @param string $mode
     */
    public function __construct($color = null, $mode = null)
    {
        $this->setHex($color);
    }

    /**
     * output a hex representation of the color
     * @return string
     */
    public function __toString()
    {
        return $this->getHex();
    }

    /**
     * @param string $color hex representation of the colour
     */
    public function setHex($color)
    {
        $color = str_replace('#', '', $color);
        if (strlen($color) == 3) {
            $color = str_repeat(substr($color, 0, 1), 2) . str_repeat(substr($color, 1, 1), 2) . str_repeat(substr($color, 2, 1), 2);
        }

        $this->color = $color;
    }

    /**
     * @return string six character hex representation of the color
     */
    public function getHex()
    {
        return '#' . $this->color;
    }

    /**
     * @return array an array in the format of ['r' => xxx, 'g' => xxx, 'b' => xxx]
     */
    public function getRGB()
    {
        $r = hexdec(substr($this->color, 0, 2));
        $g = hexdec(substr($this->color, 2, 2));
        $b = hexdec(substr($this->color, 4, 2));

        return [
            'r' => $r,
            'g' => $g,
            'b' => $b
        ];
    }

    /**
     * @param int $amount (0 - 255)
     *
     * @return string the adjusted color
     */
    public function darken($amount)
    {
        return $this->adjustBrighness($amount * -1);
    }

    /**
     * @param int $amount (0 - 255)
     *
     * @return string the adjusted color
     */
    public function lighten($amount)
    {
        return $this->adjustBrighness($amount);
    }

    /**
     * @param int $amount (0 - 255)
     *
     * @return string
     */
    protected function adjustBrighness($amount)
    {
        $colors = $this->getRGB();
        $hex = '';
        foreach ($colors as $color => $value) {
            $colors[$color] = max(0, min(255, $value + $amount));
            $hex .= str_pad(dechex($colors[$color]), 2, '0', STR_PAD_LEFT);
        }
        $this->setHex($hex);
        return $this->getHex();
    }

    /**
     * @param $hex
     *
     * @return array
     */
    public static function HexToRGB($hex)
    {
        $c = new Color($hex, 'hex');
        return $c->getRGB();
    }
}