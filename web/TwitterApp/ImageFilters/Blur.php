<?php

namespace ImageFilters;

class Blur implements ImageFilter {

    public static function filter($im)
    {
        imagefilter($im, IMG_FILTER_SELECTIVE_BLUR);
    }

}