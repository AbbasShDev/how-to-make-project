<?php

function presentImage($path)
{
    return "https://watheqah.s3.eu-west-3.amazonaws.com/".$path;
//    return "https://tusd.tusdemo.net/".$path;
}

function getYoutubeId($url){
    $headers = get_headers('http://www.youtube.com/oembed?url='.$url);

    if (!strpos($headers[0], '200')) {
        return null;
    }else{
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        return $matches[0];
    }

}
