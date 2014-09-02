<?php

namespace feedify;

class Resource_FeedPage extends Resource_Anstract {

    public function __construct($feedpage) {
        $this_>_feedpage = $feedpage;
    }

    public function getItems() {
        $entryListNew = array();
        $entryList = getClient("feedpages/id/items");
        foreach($entryList as $entry) {
            $entryListNew[] = new Resource_FeedEntry($entry);
        }
    }
}
