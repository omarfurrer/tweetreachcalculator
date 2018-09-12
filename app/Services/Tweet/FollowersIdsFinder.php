<?php

namespace App\Services\Tweet;

use App\Services\API\TwitterClient;

class FollowersIdsFinder {

    /**
     * @var TwitterClient 
     */
    protected $twitterClient;

    /**
     * FollwersIdsFinder Constructor.
     * 
     * @param TwitterClient $twitterClient
     */
    public function __construct(TwitterClient $twitterClient)
    {
        $this->twitterClient = $twitterClient;
    }

    /**
     * Get all followers ids for a specific user.
     * 
     * @param Integer $userID
     * @return boolean|array
     */
    public function find($userID)
    {
        if (empty($userID)) {
            return false;
        }

        $followers = [];

        $cursor = -1;

        do {
            $response = $this->twitterClient->getFollowersIds($userID, $cursor);

            if (!$response) {
                return $response;
            }

            if (!property_exists($response, 'ids')) {
                return false;
            }

            $followers = array_merge($followers, $response->ids);
            $cursor = $response->next_cursor;
        } while ($cursor != 0);


        return $followers;
    }

}
