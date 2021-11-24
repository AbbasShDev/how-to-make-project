<?php

if ( ! function_exists('presentImage')) {
    function presentImage($path)
    {
        return "https://watheqah.s3.eu-west-3.amazonaws.com/" . $path;
    }
}

if ( ! function_exists('presentProfileImage')) {
    function presentProfileImage($user, $size = null, $rounded = false)
    {
        if($user->profile_image){
            return "https://watheqah.s3.eu-west-3.amazonaws.com/" . $user->profile_image;
        }

        $presentSize = $size ? "&size={$size}" : "";

        return "https://ui-avatars.com/api/?name={$user->name}&color=30373B&background=FFFFFF&rounded={$rounded}{$presentSize}";
    }
}

if ( ! function_exists('presentUrl')) {
    function presentUrl($url)
    {
        if(!strpos($url, "//")){
            return $url;
        }

        return explode("//", $url)[1];
    }
}

if ( ! function_exists('getYoutubeId')) {
    function getYoutubeId($url)
    {

        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);

        return isset($matches[0]) ? $matches[0] : null;


    }
}
