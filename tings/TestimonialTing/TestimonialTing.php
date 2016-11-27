<?php

class TestimonialTing extends Ting {


    private static $has_many = [
        'Testimonials' => 'Testimonial'
    ];

    function getCMSFields() {
        $fields = parent::getCMSFields();

        $testimonialConfig = GridFieldConfig_RelationEditor::create(10);
        $testimonialConfig->addComponent(GridFieldOrderableRows::create('SortOrder'))
                          ->removeComponentsByType('GridFieldDeleteAction')
                          ->addComponent(new GridFieldDeleteAction(false))
                          ->removeComponentsByType('GridFieldAddExistingAutoCompleter');


        $testimonialGridfield = GridField::create(
            'Testimonials',
            'Testimonials',
            $this->Testimonials(),
            $testimonialConfig
        );

        $fields->addFieldsToTab('Root.Main', array(
            $testimonialGridfield
        ));


        return $fields;
    }

}
