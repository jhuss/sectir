<?php

/**
 * Description of DefaultValueBehavior
 *
 * @author asdrubalivan
 */
class DefaultValueBehavior extends CActiveRecordBehavior{
    public $attribute;
    public $value;
    
    public function beforeSave($event) {
        $this->getOwner()->{$this->attribute} = $this->value;
    }
}
