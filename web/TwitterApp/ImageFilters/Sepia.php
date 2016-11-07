<?php

namespace ImageFilters;

class Sepia implements ImageFilter {

    public static function filter($im)
    {
        imagefilter($im,IMG_FILTER_GRAYSCALE);
        imagefilter($im,IMG_FILTER_COLORIZE,100,50,0);
    }

}