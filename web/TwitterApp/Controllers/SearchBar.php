<?php

namespace Controllers;

use Repository\GalleryRepository;
use Repository\PhotoRepository;
use Repository\UserRepository;
use templates\Main;
use templates\SearchResults;

class SearchBar implements Controller {

    /**
     * Method lists users, galleries and images that match provided string.
     */
    public function action()
    {

        if(post('search')) {
            $str = post('search');
            $str = preg_replace("#[^0-9a-z]#i","",$str);

            //getting search results that match given string
            $users = UserRepository::searchUsers($str);
            $galleries = GalleryRepository::searchGalleries($str);
            $photos = PhotoRepository::searchPhotos($str);


            //showing results
            $searchResults = new SearchResults();
            $searchResults->setUsers($users);
            $searchResults->setGalleries($galleries);
            $searchResults->setPhotos($photos);
            echo $searchResults;
        }
    }

    public function advancedSearch() {
        if(post('submitSearch')) {
            $str = post('searchInput');
//            $str = preg_replace("#[^0-9a-z]#i","",$str);

            //parsiranje AND-ova i OR-ova

            $values = preg_split("/[\s,]+/", $str);

            $photos = PhotoRepository::getAllPhotos();
            $tags = array(); //svi tagovi od svih slika

            foreach($photos as $photo) {
                array_push($tags, $photo['tags']);
            }

//            $stack = new \SplStack();
//
//            foreach($values as $value) {
//                if(strtolower($value) != "and" && strtolower($value) != "or") {
//                    $stack->push($value);
//                }
//            }



            //showing results
            $main = new Main();
            $searchResults = new SearchResults();
            $searchResults->setPhotos($photos);
            echo "<div class='container'>";
            echo $main->setBody($searchResults);
        }
    }

}