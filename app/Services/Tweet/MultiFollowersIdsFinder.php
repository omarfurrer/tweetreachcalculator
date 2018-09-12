<?php

namespace App\Services\Tweet;

use App\Services\Tweet\FollowersIdsFinder;

class MultiFollowersIdsFinder {

    /**
     * @var FollowersIdsFinder 
     */
    protected $followersIdsFinder;

    /**
     * MultiFollowersIdsFinder Construct.
     * 
     * @param FollowersIdsFinder $followersIdsFinder
     */
    public function __construct(FollowersIdsFinder $followersIdsFinder)
    {
        $this->followersIdsFinder = $followersIdsFinder;
    }

    /**
     * Returns an array containing all followers given an array of user IDs.
     * 
     * @param array $userIds
     * @return boolean|array
     */
    public function find($userIds)
    {
        if (empty($userIds) || !is_array($userIds)) {
            return false;
        }

        $followers = [];

        foreach ($userIds as $userId) {
            $userFollowers = $this->followersIdsFinder->find($userId);
            if (!$userFollowers) {
                return $userFollowers;
            }
            $followers = array_merge($followers, $userFollowers);
        }

        return $followers;
    }

}
