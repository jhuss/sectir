<?php

class m141218_141756_create_requerimientos_table extends CDbMigration
{
	public function up()
	{
        $this->createTable("{{Requerimientos}}",array(
            'id' => 'pk',
            'pregunta_id' => 'INT(11) NOT NULL',
            'tipoencuesta_id' => 'INT(11) NOT NULL',
            'tipo_requerimiento' => 'VARCHAR(32) NOT NULL',
            'datos' => 'TEXT',
        ));
        $this->addForeignKey("fk_{{Requerimientos}}_{{Pregunta}}",
            "{{Requerimientos}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id");
        $this->addForeignKey("fk_{{Requerimientos}}_{{Tipoencuesta}}",
            "{{Requerimientos}}",
            "tipoencuesta_id",
            "{{Tipoencuesta}}",
            "id");
	}

	public function down()
	{
        $this->dropForeignKey("fk_{{Requerimientos}}_{{Pregunta}}",
            "{{Requerimientos}}");
        $this->dropForeignKey("fk_{{Requerimientos}}_{{Tipoencuesta}}",
            "{{Requerimientos}}");
        $this->dropTable("{{Requerimientos}}");
	}

	/*
	// Use safeUp/safeDown to do migration  transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
