<?php

class Ting extends DataObject {

    private static $db = [
        'Order'    => 'Int',
        'ParentID' => 'Int',

        'PaddingTop'    => 'Varchar',
        'PaddingRight'  => 'Varchar',
        'PaddingBottom' => 'Varchar',
        'PaddingLeft'   => 'Varchar',

        'MarginTop'    => 'Varchar',
        'MarginRight'  => 'Varchar',
        'MarginBottom' => 'Varchar',
        'MarginLeft'   => 'Varchar',

        'BackgroundColour' => 'Color',

    ];

    private static $defaults = [
        'PaddingTop'    => '0',
        'PaddingRight'  => '0',
        'PaddingBottom' => '0',
        'PaddingLeft'   => '0',

        'MarginTop'    => '0',
        'MarginRight'  => 'auto',
        'MarginBottom' => '0',
        'MarginLeft'   => 'auto',

        'BackgroundColour' => '#ffffff',
    ];

    private static $summary_fields = [
        'Order' => 'Sort',
        'Type'  => 'Type'
    ];

    private static $default_sort = 'Order';

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Padding', [
                TextField::create('PaddingTop', 'Padding Top'),
                TextField::create('PaddingRight', 'Padding Right'),
                TextField::create('PaddingBottom', 'Padding Bottom'),
                TextField::create('PaddingLeft', 'Padding Left'),
            ]
        );
        $fields->addFieldsToTab('Root.Margin', [
                TextField::create('MarginTop', 'Margin Top'),
                TextField::create('MarginRight', 'Margin Right'),
                TextField::create('MarginBottom', 'Margin Bottom'),
                TextField::create('MarginLeft', 'Margin Left'),
            ]
        );
        $fields->addFieldsToTab('Root.Background', [
                ColorField::create('BackgroundColour', 'Background Colour'),
            ]
        );
        return $fields;
    }

    public function getIncludeTemplate() {
        return $this->renderWith($this->ClassName . '_cms');
    }

    public function prettyName($removeWords = ['Ting', 'ting']) {
        return str_replace($removeWords, '', $this->ClassName) . ' Block';
    }

    public function getRenderTemplate() {
        return $this->renderWith($this->ClassName . '_site');
    }


}

class Ting_Controller extends LeftAndMain {

    static $url_segment = 'ting';

    static $allowed_actions = [
        'createTing',
        'updateTing',
        'destroyTing',
        'reorderTings',
        'saveTing',
        'TingForm'
    ];

    function reorderTings(SS_HTTPRequest $request) {
        $tingIDs = $request->getVar('Order');
        $order   = [];
        $count   = 0;
        foreach ($tingIDs as $tingID) {
            $order[$tingID] = $count * 5;
            $ting           = DataObject::get_by_id('Ting', $tingID);
            if ($ting) {
                $ting->Order = $count * 5;
                $ting->write();
            }
            $count ++;
        }
        ksort($order);
        return json_encode($order);
    }

    function createTing(SS_HTTPRequest $request) {
        $parentID       = $request->getVar('ParentID');
        $type           = $request->getVar('Type');
        $ting           = $type::create();
        $ting->ParentID = $parentID;
        $ting->Order    = 10000;
        if ($ting->write()) {
            return $ting->renderWith($type . '_cms');
        } else {
            return 'error';
        }
    }

    function destroyTing(SS_HTTPRequest $request) {
        $tingID = $request->getVar('tingID');
        $type   = $request->getVar('Type');
        $ting   = $type::get()->byID($tingID);
        if ($ting) {
            $ting->delete();
            return 'success';
        } else {
            return 'Ting doesnt Exist';
        }
    }

    function updateTing(SS_HTTPRequest $request) {
        $tingID = $request->getVar('tingID');
        $type   = $request->getVar('Type');
        $ting   = $type::get()->byID($tingID);

        $fields = $ting->getCMSFields();
        $fields->removeByName(['ParentID', 'ID', 'Order']);

        $actions = FieldList::create(
            FormAction::create('cancelTing', 'Cancel'),
            FormAction::create('saveTing', 'Save')->setAttribute('data-ting-id', $tingID)->setAttribute('data-type', $type)
        );

        $requiredFields = RequiredFields::create();

        $form = Form::create($this, 'TingForm', $fields, $actions, $requiredFields)->loadDataFrom($ting);

        return $form->renderWith('TingForm');
    }

    public function saveTing(SS_HTTPRequest $request) {

        $tingID   = $request->getVar('tingID');
        $type     = $request->getVar('Type');
        $formData = $request->getVar('formData');

        $params = array();

        parse_str($formData, $params);

        $ting = $type::get()->byID($tingID);

        $ting->update($params);

        $ting->write();
        return 'You know nothing jon snow';
    }


}