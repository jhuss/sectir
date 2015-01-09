<?php

/**
 * Class CrearEncuestaCommand
 * @author Me
 */
class CrearEncuestaCommand extends CConsoleCommand
{
    public function run($args)
    {
        $tipoencuesta = Tipoencuesta::model()
            ->findAllByAttributes(array(
                'identificador' => array("tipoencuesta_uni","tipoencuesta_otros")
            ));
        $usuarioSQL = "SELECT id FROM {{users}} WHERE username = :username LIMIT 1";
        $command = Yii::app()->db->createCommand($usuarioSQL);
        $userid = $command->queryScalar(array(
            ':username' => 'admin'
        ));
        $sqlInsert = <<<EOF
INSERT INTO {{Encuesta}} (tipoencuesta_id ,  enunciado ,  identificador ,  fecha_inicial ,  fecha_final ,  creado_en ,  actualizado_en ,  user_id ,  ano ) VALUES
(:tipoencuesta_id, 'Test', 'test_encuesta_comm', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-12-17 21:17:11', '0000-00-00 00:00:00', :userid, 2014);
EOF;
        $commandEncuesta = Yii::app()->db->createCommand($sqlInsert);
        foreach ($tipoencuesta as $te) {
            $filasAfectadas = $commandEncuesta->execute(array(
                ':userid' => $userid,
                ':tipoencuesta_id' => $te->id,
            ));
            echo "Comando de insertar encuesta afectó $filasAfectadas";
        }
    }
}

