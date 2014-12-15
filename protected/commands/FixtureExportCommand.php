<?php

/**
 * Class FixtureExportCommand
 * @author Me
 */
class FixtureExportCommand extends CConsoleCommand
{
    public function run($args)
    {
        $sql = "SELECT * FROM {{Pregunta}} WHERE 1";
        $command = Yii::app()->db->createCommand($sql);
        var_export($command->queryAll());
    }
}

