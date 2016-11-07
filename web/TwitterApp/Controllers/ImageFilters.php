<?php

namespace Controllers;

use ImageFilters\BlackWhite;
use ImageFilters\BlackWhiteFilter;
use ImageFilters\Blur;
use ImageFilters\Brightness;
use ImageFilters\Sepia;
use Repository\PhotoRepository;
use route\Route;

class ImageFilters implements Controller {

    public function action()
    {

        $photoID = getParamFromURL("id");
        $filter = getParamFromURL("filter");
        $photo = PhotoRepository::getPhotoByID($photoID);
        $path = substr($photo['path'], 12);

        $im = null;
        $imageType = null;

        if(endsWith($photo['image'], ".jpeg") || endsWith($photo['image'], ".jpg")) {
            $im = imagecreatefromjpeg($path);
            $imageType = "jpeg";
        } else if(endsWith($photo['image'], ".png")) {
            $im = imagecreatefrompng($path);
            $imageType = "png";
        }

        if($filter === "blackwhite") {
            BlackWhite::filter($im);
        } else if($filter === "brightness") {
            $brightness = post('number');
            Brightness::setBrightness($brightness);
            Brightness::filter($im);
        } else if($filter === "sepia") {
            Sepia::filter($im);
        } else if($filter === "blur") {
            Blur::filter($im);
        }
        header('Content-Type: image/' . $imageType);
        if($imageType === "jpeg") {
            imagejpeg($im);
            imagejpeg($im, $path);
        } else {
            imagepng($im);
        }
        imagedestroy($im);
        redirect(Route::get("viewPhoto")->generate(array("id" => $photo['photoid'])));
    }

}