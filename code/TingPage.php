<?php

class TingPage extends Page {

    private static $has_many = [
        'Tings' => 'Ting'
    ];

    public function forCMSTemplate() {
        return $this->renderWith('Tings_cms');
    }


    public function getTings() {
        return DataObject::get(
            $obj = "Ting",
            $filter = '"ParentID" = ' . $this->ID,
            $sort = "Order",
            $join = "",
            $limit = ""
        );
    }




    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Content');
        $fields->addFieldToTab('Root.Tings', LiteralField::create('Blocks', $this->forCMSTemplate()));
        return $fields;
    }
}

class TingPage_Controller extends Page_Controller {
}