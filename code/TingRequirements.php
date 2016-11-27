<?php

class TingRequirements extends Extension {
    public function init() {
        Requirements::css('ting/dist/styles/style.css');
        Requirements::javascript('ting/js/Dragula.js');
        Requirements::javascript('ting/js/Ting.js');
    }
}