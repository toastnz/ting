<?php

class Testimonial extends DataObject {

    private static $db = [
        'SortOrder'   => 'Int',
        'TingContent' => 'HTMLText'
    ];

    private static $has_one = [
        'TestimonialTing' => 'TestimonialTing'
    ];

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main',
            HtmlEditorField::create('TingContent', 'Testimonial')
        );
        return $fields;
    }

}
