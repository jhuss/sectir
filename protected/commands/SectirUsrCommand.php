<?php

Yii::import("application.vendor.nineinchnick.yii-usr.commands.UsrCommand");

/**
 * Class SectirUsrCommand
 * @author Me
 */
class SectirUsrCommand extends UsrCommand
{
    public function getTemplateAuthItems()
    {
        $parentItems = parent::getTemplateAuthItems();
        $parentItems[] = array('name' => 'responder', 'child' => null);
        $parentItems[] = array('name' => 'responder.tipoencuesta_uni', 'child' => 'responder');
        $parentItems[] = array('name' => 'responder.tipoencuesta_otros', 'child' => 'responder');
        return $parentItems;
    }
    public function getTemplateAuthItemDescriptions()
    {
        $parentDescr = parent::getTemplateAuthItemDescriptions();
        $parentDescr['responder'] = Yii::t('SectirUsrCommand','Responder Encuestas');
        $parentDescr['responder.tipoencuesta_uni'] = 
            Yii::t('SectirUsrCommand','Responder encuestas del tipo universidad');
        $parentDescr['responder.tipoencuesta_otros'] = 
            Yii::t('SectirUsrCommand','Responder encuestas de otros tipos');
        return $parentDescr;
    }
}

