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