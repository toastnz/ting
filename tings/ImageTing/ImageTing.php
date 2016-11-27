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

    public function customUpdate($data)
    {
        parent::update($data);
        if(isset($data['Image']) && isset($data['Image']['Files'])) {
            $this->ImageID = reset($data['Image']['Files']);
        }
    }

}
