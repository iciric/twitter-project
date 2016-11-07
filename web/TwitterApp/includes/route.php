<?php

use route\DefaultRoute;
use route\Route;

Route::register("index", new DefaultRoute("index", array(
    "controller" => "index",
    "action" => "action")));

Route::register("errorPage", new DefaultRoute("error/404", array(
    "controller" => "errorPage",
    "action" => "action")));

Route::register("unauthorizedAccess", new DefaultRoute("error/access/denied", array(
    "controller" => "unauthorizedAccess",
    "action" => "action")));

Route::register("notFriends", new DefaultRoute("error/friends", array(
    "controller" => "notFriends",
    "action" => "action")));

Route::register("register", new DefaultRoute("register", array(
    "controller" => "register",
    "action" => "action")));

Route::register("twitterWall", new DefaultRoute("wall/<id>", array(
        "controller" => "twitterWall",
        "action" => "action"
    ), array(
        "galleryID" => "\\d+"
    ))
);

Route::register("searchBar", new DefaultRoute("search", array(
        "controller" => "searchBar",
        "action" => "action"
    ))
);

Route::register("advancedSearch", new DefaultRoute("search/advanced", array(
        "controller" => "searchBar",
        "action" => "advancedSearch"
    ))
);


Route::register("logout", new DefaultRoute("logout", array(
    "controller" => "index",
    "action" => "logout")));

Route::register("changeProfilePicture", new DefaultRoute("settings/picture", array(
    "controller" => "settings",
    "action" => "action")));

Route::register("changePassword", new DefaultRoute("settings/password", array(
    "controller" => "settings",
    "action" => "changePassword")));

Route::register("changeUsername", new DefaultRoute("settings/username", array(
    "controller" => "settings",
    "action" => "changeUsername")));

Route::register("changeVisibility", new DefaultRoute("settings/visibility", array(
    "controller" => "settings",
    "action" => "changeVisibility")));

Route::register("addGallery", new DefaultRoute("gallery/add", array(
    "controller" => "addGallery",
    "action" => "action")));

Route::register("listGalleries", new DefaultRoute("galleries", array(
    "controller" => "listGalleries",
    "action" => "action")));

Route::register("viewGallery", new DefaultRoute("gallery/<id>", array(
        "controller" => "viewGallery",
        "action" => "action"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("addPhoto", new DefaultRoute("photo/add/<galleryID>", array(
        "controller" => "addPhoto",
        "action" => "action"
    ), array(
        "galleryID" => "\\d+"
    ))
);

Route::register("viewPhoto", new DefaultRoute("photo/<id>", array(
        "controller" => "viewPhoto",
        "action" => "action"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("setGalleryIcon", new DefaultRoute("icon/<id>", array(
        "controller" => "viewPhoto",
        "action" => "setGalleryIcon"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("setUserBackground", new DefaultRoute("background/<id>", array(
        "controller" => "viewPhoto",
        "action" => "setUserBackground"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("listUsers", new DefaultRoute("users", array(
    "controller" => "listUsers",
    "action" => "action"
    )));

Route::register("userProfile", new DefaultRoute("profile/<id>", array(
        "controller" => "userProfile",
        "action" => "action"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("sendFriendRequest", new DefaultRoute("request/send/<id>", array(
        "controller" => "userProfile",
        "action" => "sendFriendRequest"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("cancelRequest", new DefaultRoute("request/cancel/<id>", array(
        "controller" => "userProfile",
        "action" => "cancelRequest"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("acceptRequest", new DefaultRoute("request/accept/<id>", array(
        "controller" => "userProfile",
        "action" => "acceptRequest"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("deleteRequest", new DefaultRoute("request/delete/<id>", array(
        "controller" => "userProfile",
        "action" => "deleteRequest"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("unfriend", new DefaultRoute("unfriend/<id>", array(
        "controller" => "userProfile",
        "action" => "unfriend"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("blockUser", new DefaultRoute("block/<id>", array(
        "controller" => "userProfile",
        "action" => "blockUser"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("unblockUser", new DefaultRoute("unblock/<id>", array(
        "controller" => "userProfile",
        "action" => "unblockUser"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("showRequests", new DefaultRoute("requests", array(
    "controller" => "listUsers",
    "action" => "showRequests")));

Route::register("showFriends", new DefaultRoute("friends", array(
    "controller" => "listUsers",
    "action" => "showFriends")));

Route::register("sendMessage", new DefaultRoute("message/send/<id>", array(
        "controller" => "messages",
        "action" => "action"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("showMessages", new DefaultRoute("messages", array(
    "controller" => "messages",
    "action" => "showMessages")));

Route::register("readMessage", new DefaultRoute("message/read/<id>", array(
        "controller" => "messages",
        "action" => "readMessage"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("sortMessages", new DefaultRoute("messages/sort/<order>", array(
    "controller" => "sortMessages",
    "action" => "action"
    ), array(
        "order" => "newest|oldest|unread|read"
    ))
);

Route::register("postTweet", new DefaultRoute("tweet/post/<id>", array(
    "controller" => "twitterWall",
    "action" => "postTweet"
), array(
    "id" => "\\d+"
    ))
);

Route::register("viewTweet", new DefaultRoute("tweet/<id>", array(
        "controller" => "viewTweet",
        "action" => "action"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("postTweetComment", new DefaultRoute("tweet/<id>/comment", array(
        "controller" => "viewTweet",
        "action" => "postTweetComment"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("postPhotoComment", new DefaultRoute("photo/<id>/comment", array(
        "controller" => "viewPhoto",
        "action" => "postPhotoComment"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("editPhotoTags", new DefaultRoute("photo/<id>/edit", array(
        "controller" => "viewPhoto",
        "action" => "editPhotoTags"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("photoRssFeed", new DefaultRoute("feed/rss/photo/<id>", array(
        "controller" => "rssFeed",
        "action" => "photoCommentsRss"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("tweetRssFeed", new DefaultRoute("feed/rss/tweet/<id>", array(
        "controller" => "rssFeed",
        "action" => "tweetCommentsRss"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("galleryRssFeed", new DefaultRoute("feed/rss/gallery/<id>", array(
        "controller" => "rssFeed",
        "action" => "galleryRssFeed"
    ), array(
        "id" => "\\d+"
    ))
);

Route::register("imageFilter", new DefaultRoute("photo/<id>/filter/<filter>", array(
        "controller" => "imageFilters",
        "action" => "action"
    ), array(
        "id" => "\\d+",
        "filter" => "blackwhite|sepia|brightness|blur"
    ))
);
