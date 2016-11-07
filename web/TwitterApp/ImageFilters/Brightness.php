<?php

namespace ImageFilters;

class Brightness implements ImageFilter {

    private static $brightness;

    public static function filter($im)
    {
        imagefilter($im, IMG_FILTER_BRIGHTNESS, self::$brightness);
    }

    /**
     * @return mixed
     */
    public static function getBrightness()
    {
        return self::$brightness;
    }

    /**
     * @param mixed $brightness
     */
    public static function setBrightness($brightness)
    {
        self::$brightness = $brightness;
    }

}