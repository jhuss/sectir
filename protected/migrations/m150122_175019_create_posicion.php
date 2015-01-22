<?php

class m150122_175019_create_posicion extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{Respuestaabierta}}","posicion","INT(11) DEFAULT 0");
        $this->addColumn("{{Respuestaopc}}","posicion","INT(11) DEFAULT 0");
        $this->addColumn("{{Respuestaano}}","posicion","INT(11) DEFAULT 0");
        $this->addColumn("{{Respuestanum}}","posicion","INT(11) DEFAULT 0");

	}

	public function down()
	{
        $this->dropColumn("{{Respuestaabierta}}","posicion");
        $this->dropColumn("{{Respuestaopc}}","posicion");
        $this->dropColumn("{{Respuestaano}}","posicion");
        $this->dropColumn("{{Respuestanum}}","posicion");
    }
}
