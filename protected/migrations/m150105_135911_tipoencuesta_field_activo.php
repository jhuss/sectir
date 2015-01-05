<?php

class m150105_135911_tipoencuesta_field_activo extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{Tipoencuesta}}", "activo", "BOOLEAN");
        $this->createIndex("{{Tipoencuesta}}_activo",
            "{{Tipoencuesta}}","activo");
	}

	public function down()
	{
        $this->dropIndex("{{Tipoencuesta}}_activo","{{Tipoencuesta}}");
        $this->dropColumn("{{Tipoencuesta}}","activo");
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
