<?php

namespace App\Services\Tweet;

use App\Services\API\TwitterClient;

    class RetweetersIdsFinder {

    /**
     * @var TwitterClient 
     */
    protected $twitterClient;

    /**
     * RetweetersFinder Constructor.
     * 
     * @param TwitterClient $twitterClient
     */
    public function __construct(TwitterClient $twitterClient)
    {
        $this->twitterClient = $twitterClient;
    }

    /**
     * Get all retweeters ids for a specific tweet.
     * Upto 100 retweeters only.
     * 
     * @param Integer $tweetID
     * @return boolean|array
     */
    public function find($tweetID)
    {
        if (empty($tweetID)) {
            return false;
        }

        $retweeters = [];

        // cursoring for the retweeters endpoint does not work for more than 100, as it is stated in the docs :
        // "Returns a collection of up to 100 user IDs belonging to users who have retweeted the Tweet specified by the id parameter."
        // https://developer.twitter.com/en/docs/tweets/post-and-engage/api-reference/get-statuses-retweeters-ids
        $cursor = -1;

        do {
            $response = $this->twitterClient->getRetweetersIds($tweetID, $cursor);

            if (!$response) {
                return $response;
            }

            if (!property_exists($response, 'ids')) {
                return false;
            }

            $retweeters = array_merge($retweeters, $response->ids);
            $cursor = $response->next_cursor;
        } while ($cursor != 0);


        return $retweeters;
    }

}
