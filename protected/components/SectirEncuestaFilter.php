<?php

/**
 * Class SectirEncuestaFilter
 * @author Me
 */
class SectirEncuestaFilter extends CFilter
{
    public $encuestaParam;
    public $return = false;
    public $message = "Usted no puede responder esta encuesta";

    public function getSQL()
    {
        return <<<EOF
SELECT 1 FROM {{Encuestarespondida}} er WHERE er.encuesta_id IN (
    SELECT e.id FROM {{Encuesta}} e 
        INNER JOIN {{Agrupacionenc}} a ON e.agrupacionenc_id = a.id
    WHERE a.id = (SELECT e1.agrupacionenc_id FROM {{Encuesta}} e1  WHERE e1.id = :encuesta_id)
) AND er.user_id = :user_id
EOF;
    }

    protected function preFilter($filterChain)
    {
        if (!isset($_GET[$this->encuestaParam])) {
            if ($this->return) {
                return false;
            } else {
                throw new CHttpException(403,
                    "Parametro {$this->encuestaParam} no ha sido especificado");
            }
        }
        $sql = $this->getSQL();
        $command = Yii::app()->db->createCommand($sql);
        $params = array(
            ':user_id' => Yii::app()->user->id,
            ':encuesta_id' => $_GET[$this->encuestaParam]
        );
        $scalar = $command->queryScalar($params);
        $error = ($scalar == 1);
        if ($error) {
            if ($this->return) {
                return false;
            } else {
                throw new CHttpException(403,$this->message);
            }
        }
        return true;
    }
}
  
