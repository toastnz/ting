<?php

class VideoTing extends Ting {

    private static $db = [
        'VideoID' => 'Varchar'
    ];

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main',
            TextField::create('VideoID', 'Video ID')
        );
        return $fields;
    }


}
