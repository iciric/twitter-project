<?php

namespace ImageFilters;

class BlackWhite implements ImageFilter {

    public static function filter($im)
    {
        imagefilter($im, IMG_FILTER_GRAYSCALE);
    }

}