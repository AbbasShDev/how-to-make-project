<?php

if (! function_exists('presentImage')) {
    function presentImage($path)
    {
        return "https://watheqah.s3.eu-west-3.amazonaws.com/" . $path;
    }
}

if (! function_exists('getYoutubeId')) {
    function getYoutubeId($url)
    {

        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);

        return isset($matches[0]) ? $matches[0] : null;


    }
}
