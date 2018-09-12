<?php

namespace App\Services\Tweet;

use App\Services\Tweet\MultiFollowersIdsFinder;
use App\Services\Tweet\RetweetersIdsFinder;
use App\Services\Tweet\UrlIdExtractor;
use Illuminate\Support\Facades\Cache;

class ReachCalculator {

    /**
     * @var MultiFollowersIdsFinder 
     */
    protected $multiFollowersIdsFinder;

    /**
     * @var RetweetersIdsFinder 
     */
    protected $retweetersIdsFinder;

    /**
     * @var UrlIdExtractor 
     */
    protected $urlIdExtractor;

    /**
     * TweetReachCalculator Calculator.
     * 
     * @param MultiFollowersIdsFinder $multiFollowersIdsFinder
     * @param RetweetersIdsFinder $retweetersIdsFinder
     * @param UrlIdExtractor $urlIdExtractor
     */
    public function __construct(MultiFollowersIdsFinder $multiFollowersIdsFinder, RetweetersIdsFinder $retweetersIdsFinder, UrlIdExtractor $urlIdExtractor)
    {
        $this->multiFollowersIdsFinder = $multiFollowersIdsFinder;
        $this->retweetersIdsFinder = $retweetersIdsFinder;
        $this->urlIdExtractor = $urlIdExtractor;
    }

    /**
     * Calculate reach of a specific tweet.
     * Get all retweeters and count all their unique followers.
     * 
     * @param String $url
     * @return Integer|Boolean
     */
    public function calculate($url)
    {
        $tweetId = $this->extractID($url);
        if (!$tweetId) {
            return $tweetId;
        }

        if (Cache::has($tweetId)) {
            return Cache::get($tweetId);
        }

        $retweeters = $this->getRetweeters($tweetId);
        if (!$retweeters) {
            return $retweeters;
        }

        $retweetersFollowers = $this->getRetweetersFollowers($retweeters);
        if (!$retweetersFollowers) {
            return $retweetersFollowers;
        }

        $reach = $this->countRetweetersFollowers($this->eliminateDupliactes($retweetersFollowers));

        Cache::put($tweetId, $reach, 120);

        return $reach;
    }

    /**
     * Extract ID from Tweet Url.
     * 
     * @param String $url
     * @return Integer
     */
    public function extractID($url)
    {
        return $this->urlIdExtractor->extract($url);
    }

    /**
     * Get retweeters for a specific tweet by its ID.
     * 
     * @param Integer $tweetId
     * @return array
     */
    public function getRetweeters($tweetId)
    {
        return $this->retweetersIdsFinder->find($tweetId);
    }

    /**
     * Get all followers for all user IDs in given array.
     * 
     * @param array $userIds
     * @return array
     */
    public function getRetweetersFollowers($userIds)
    {
        return $this->multiFollowersIdsFinder->find($userIds);
    }

    /**
     * Count followers in array.
     * 
     * @param array $followers
     * @return Integer
     */
    public function countRetweetersFollowers($followers)
    {
        return count($followers);
    }

    /**
     * Eliminate duplicates from array of followers.
     * 
     * @param array $followers
     * @return array
     */
    public function eliminateDupliactes($followers)
    {
        return array_unique($followers);
    }

}
