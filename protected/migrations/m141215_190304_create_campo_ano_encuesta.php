<?php

class m141215_190304_create_campo_ano_encuesta extends CDbMigration
{
	public function up()
    {
        $this->addColumn("{{Encuesta}}","ano","SMALLINT(6) UNSIGNED NOT NULL");
	}

	public function down()
	{
        $this->dropColumn("{{Encuesta}}","ano");	
	}
}
