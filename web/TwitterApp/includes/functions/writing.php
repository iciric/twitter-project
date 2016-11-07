<?php

/**
 * Function parses text after user gets it from database and before showing it in template.
 * It enables user to write simple emoticons and to write text in bold and italic style.
 * @param $text
 * @return mixed
 */
function parseText($text) {
    //reaplaces :) and :( in text with emoticons
    $chars = array(HAPPY, SAD);
    $icons = array(HAPPY_ICON, SAD_ICON);
    $new_str = str_replace($chars, $icons, $text);

    //replaces //**text**// with italic and bold text
    $matches = array();
    $allText = array();

    //find all //**text**//
    if (preg_match_all(BOLD_ITALIC, $text, $matches)) {
        foreach($matches[0] as $match) {
            array_push($allText, $match);
        }
    }

    $replacements = array();
    $counter = 0;

    //removes '/' and '*' from string
    foreach($allText as $txt) {
        $txt = str_replace("/", "", $txt);
        $txt = str_replace("*", "", $txt);
        $replacements[$counter] = $txt;
        $counter++;
    }

    $counter = 0;

    //replaces text with italic and bold text
    foreach($matches[0] as $m) {
        if(strpos($new_str, $m) !== false) {
            $new_str = str_replace($m, "<b><i>" . $replacements[$counter] . "</i></b>", $new_str);
        }
        $counter++;
    }

    //replaces **text** with bold text
    $matches = array();
    $boldText = array();

    //finds all **text**
    if (preg_match_all(BOLD, $text, $matches)) {
        foreach($matches[0] as $match) {
            array_push($boldText, $match);
        }
    }

    $replacements = array();
    $counter = 0;

    //removes '*' from string
    foreach($boldText as $bold) {
        $bold = strtr ($bold, array ('*' => ''));
        $replacements[$counter] = $bold;
        $counter++;
    }

    $counter = 0;

    //replaces text with italic text
    foreach($matches[0] as $m) {
        if(strpos($new_str, $m) !== false) {
            $new_str = str_replace($m, "<b>" . $replacements[$counter] . "</b>", $new_str);
        }
        $counter++;
    }

    //replaces //text// with italic text
    $matches = array();
    $italicText = array();

    //finds all //text//
    if (preg_match_all(ITALIC, $text, $matches)) {
        foreach($matches[0] as $match) {
            array_push($italicText, $match);
        }
    }

    $replacements = array();

    $counter = 0;

    //removes '/' from string
    foreach($italicText as $bold) {
        $bold = strtr ($bold, array ('/' => ''));
        $replacements[$counter] = $bold;
        $counter++;
    }

    $counter = 0;

    //replaces text with italic text
    foreach($matches[0] as $m) {
        if(strpos($new_str, $m) !== false) {
            $new_str = str_replace($m, "<i>" . $replacements[$counter] . "</i>", $new_str);
        }
        $counter++;
    }

    return $new_str;

}