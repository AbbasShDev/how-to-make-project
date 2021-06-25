<?php

function presentImage($path)
{
    return "https://tusd.tusdemo.net/".$path;
}

function getYoutubeId($url){
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
    return $matches[0];
}
