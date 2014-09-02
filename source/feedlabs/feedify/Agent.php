<?php

namespace feedlabs\feedify;

class Agent {

    public function __construct() {

    }

    public function getClient() {

    }

    public function FeedPages(){
        $listNew = array();
        $list = getClient("feedpages");
        foreach($list as $feedpage) {
            $listNew[] = new Resource_FeedPage($feedpage);
        }
    }
}
