<?php

if (!function_exists('getYoutubeIdFromUrl')) {
    function getYoutubeIdFromUrl(string $url): ?string
    {
        $regex = "/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/|shorts\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/";
        $matches = [];
        $isMatch = preg_match($regex, $url, $matches);
        return $isMatch ? $matches[1] : null;
    }
}
