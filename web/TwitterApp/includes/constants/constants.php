<?php

/**
 * Constants for connecting to database.
 * Database name, host, username and password.
 */
define('DBNAME', 'learning');
define('HOST', 'localhost');
define('USER', 'iciric');
define('PASSWORD', 'iciric12345');

/**
 * Constants for advanced text writing.
 * Happy and sad emoticon and images that replace them.
 * Regular expressions for matching bold, italic and bold and italic text.
 */
define('HAPPY', ':)');
define('SAD', ':(');
define('HAPPY_ICON', "<img src='/TwitterApp/assets/smileys/happy.jpg' width='20' height='15' alt='happy'>");
define('SAD_ICON', "<img src='/TwitterApp/assets/smileys/sad.png' width='19' height='14' alt='sad'>");
define('BOLD_ITALIC', '#[\/][\/][*][*][a-zA-Z0-9]+[*][*][\/][\/]#');
define('BOLD', '/[*]+[^*]+[*]+/');
define('ITALIC', '#[/]+[^/]+[/]+#');

/**
 * Constants for rss feed generator.
 */
define('VERSION', '2.0');