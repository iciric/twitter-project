<?php

function generateCommentsRss($title, $link, $description, $content) {

    header('Content-Type: text/xml; charset=UTF-8');

    $xml = new \SimpleXMLElement('<rss/>');
    $xml->addAttribute("version", VERSION);

    $channel = $xml->addChild("channel");

    $channel->addChild("title", $title);
    $channel->addChild("link", $link);
    $channel->addChild("description", $description);

    foreach($content as $c) {
        $item = $channel->addChild("item");
        $item->addChild("title", "Komentar");
        $item->addChild("description", html_entity_decode($c['content']));
    }

    echo $xml->asXML();
}

function generateGalleryRss($title, $link, $description, $photos) {

    header('Content-Type: text/xml; charset=UTF-8');

    $xml = new \SimpleXMLElement('<rss/>');
    $xml->addAttribute("version", VERSION);

    $channel = $xml->addChild("channel");

    $channel->addChild("title", $title);
    $channel->addChild("link", $link);
    $channel->addChild("description", $description);

    foreach ($photos as $photo) {
        $item = $channel->addChild("item");
        $item->addChild("title", $photo['title']);
        $item->addChild("description", $photo['tags']);
        $item->addChild("guid", "http://192.168.56.101/TwitterApp/photo/" . $photo['photoid']);
    }

    echo $xml->asXML();
}