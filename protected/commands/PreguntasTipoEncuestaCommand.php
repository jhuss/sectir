<?php

/**
 * Class PreguntasTipoEncuestaCommand
 * @author Me
 */
class PreguntasTipoEncuestaCommand extends CConsoleCommand
{
    public function run($args)
    {
        $te = Tipoencuesta::model()->findByAttributes(
            array(
                'identificador' => 'tipoencuesta_uni'
            )
        );
        $te->preguntasEncuesta;
    }
}

