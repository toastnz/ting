<?php

/**
 * Created by PhpStorm.
 * User: Nivanka Fonseka
 * Date: 25/11/2016
 * Time: 06:58
 */
class TingFormUploadField extends UploadField
{


    /**
     * @param int $itemID
     * @return UploadField_ItemHandler
     */
    public function getItemHandler($itemID) {
        return TingFormUploadField_RequestHandler::create($this, $itemID);
    }

    /**
     * @param SS_HTTPRequest $request
     * @return UploadField_ItemHandler
     */
    public function handleSelect(SS_HTTPRequest $request) {
        if(!$this->canAttachExisting()) return $this->httpError(403);
        return TingUploadField_SelectHandler::create($this, $this->getFolderName());
    }

}

class TingFormUploadField_RequestHandler extends UploadField_ItemHandler
{

    public function QueryString()
    {
        if(Controller::has_curr()) {
            return '?Type=' . Controller::curr()->getRequest()->requestVar('Type') . '&tingID=' . Controller::curr()->getRequest()->requestVar(tingID);
        }
        return '';
    }

    public function Link($action = null) {

        return Controller::join_links($this->parent->Link(), '/item/', $this->itemID, $action, $this->QueryString());
    }

    /**
     * @return string
     */
    public function DeleteLink() {
        $token = $this->parent->getForm()->getSecurityToken();
        return Controller::join_links($token->addToUrl($this->Link('delete')), $this->QueryString());
    }

    /**
     * @return string
     */
    public function EditLink() {
        return Controller::join_links($this->Link('edit'), $this->QueryString());
    }

}

class TingUploadField_SelectHandler extends UploadField_SelectHandler
{

    public function QueryString()
    {
        if(Controller::has_curr()) {
            return '?Type=' . Controller::curr()->getRequest()->requestVar('Type') . '&tingID=' . Controller::curr()->getRequest()->requestVar(tingID);
        }
        return '';
    }

    public function Link($action = null) {
        return Controller::join_links($this->parent->Link(), '/select/', $action, $this->QueryString());
    }

}