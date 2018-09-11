<?php

namespace App\Services\Tweet;

class UrlIdExtractor {

    /**
     * UrlIdExtractor constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Using a tweet URL extract its ID.
     * 
     * @param string $url
     * @return string|boolean
     */
    public function extract($url)
    {
        if (!$this->validateUrl($url)) {
            return false;
        }

        $explodedUrl = explode("/", $url);

        return end($explodedUrl);
    }

    /**
     * Validate url and make sure its not empty && is a string && matches Twitter tweet URL.
     * 
     * @param string $url
     * @return boolean
     */
    public function validateUrl($url)
    {
        if (empty($url) || !is_string($url) || !preg_match('(^https:\/\/twitter.com\/([A-Za-z0-9]+)\/status\/([0-9]+)$)', $url)) {
            return false;
        }
        return true;
    }

}
