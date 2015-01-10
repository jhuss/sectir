<?php

class m150110_190530_encuesta_activo extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{Encuesta}}","activa","TINYINT(1) DEFAULT 0");
	}

	public function down()
    {
        $this->dropColumn("{{Encuesta}}","activa");
	}
}
