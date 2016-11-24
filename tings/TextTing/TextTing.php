<?php

class TextTing extends Ting {

    private static $db = [
        'TingContent' => 'HTMLText'
    ];

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main',
            HtmlEditorField::create('TingContent', 'Content')
        );
        return $fields;
    }
}
