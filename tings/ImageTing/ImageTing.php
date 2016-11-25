<?php

class ImageTing extends Ting {

    private static $has_one = [
        'Image' => 'Image'
    ];

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main',
            TingFormUploadField::create('Image', 'Image')
        );
        return $fields;
    }

}
