<?php

namespace App\Services\API;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterClient {

    CONST GET_STATUS_RETWEETERS_IDS_URL = 'statuses/retweeters/ids';
    CONST GET_FOLLOWERS_IDS_URL = 'followers/ids';

    /**
     * @var TwitterOAuth 
     */
    protected $twitterOauth;

    /**
     * @var String 
     */
    protected $consumerKey;

    /**
     * @var String 
     */
    protected $consumerSecret;

    /**
     * @var String 
     */
    protected $accessToken;

    /**
     * @var String 
     */
    protected $accessTokenSecret;

    /**
     * TwitterClient Constructor.
     */
    public function __construct()
    {
        $this->consumerKey = config('services.twitter.consumer_key');
        $this->consumerSecret = config('services.twitter.consumer_secret');
        $this->accessToken = config('services.twitter.access_token');
        $this->accessTokenSecret = config('services.twitter.token_secret');
        $this->twitterOauth = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $this->accessToken, $this->accessTokenSecret);
    }

    /**
     * Get IDs of users who re-tweeted a specific tweet using its ID.
     * 
     * @param Integer $id
     * @param String $cursor
     * @return boolean|array
     */
    public function getRetweetersIds($id, $cursor = '-1')
    {
        if (empty($id)) {
            return false;
        }

        return $this->_sendRequest(self::GET_STATUS_RETWEETERS_IDS_URL, ['id' => $id, 'cursor' => $cursor]);
    }

    /**
     * Get IDs of users who are following a specific user using the user_id.
     * 
     * @param Integer $userId
     * @param String $cursor
     * @return boolean|array
     */
    public function getFollowersIds($userId, $cursor = '-1')
    {
        if (empty($userId)) {
            return false;
        }

        return $this->_sendRequest(self::GET_FOLLOWERS_IDS_URL, ['user_id' => $userId, 'cursor' => $cursor]);
    }

    /**
     * Send a GET or POST request to twitter API.
     * 
     * @param String $path
     * @param array $parameters
     * @param String $method
     * @return boolean|array
     */
    protected function _sendRequest($path, $parameters = [], $method = 'GET')
    {
        if (empty($path) || !in_array($method, ['GET', 'POST'])) {
            return false;
        }

        try {
            switch ($method) {
                case 'GET':
                    $response = $this->twitterOauth->get($path, $parameters);
                    break;
            }
        } catch (Exception $ex) {
            // TODO: LOG exception
            return false;
        }

        return $response;
    }

}
