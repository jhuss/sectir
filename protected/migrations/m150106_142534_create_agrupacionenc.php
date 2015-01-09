<?php

class m150106_142534_create_agrupacionenc extends CDbMigration
{
	public function up()
	{
        $this->createTable("{{Agrupacionenc}}",array(
            'id' => 'pk',
            'nombre' => 'VARCHAR(64) NOT NULL',
            'user_id' => 'INT(11) NOT NULL',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
        ));
        $this->addForeignKey("{{Agrupacionenc}}_users","{{Agrupacionenc}}",
            "user_id","{{users}}", "id");
	}

	public function down()
	{
        $this->dropForeignKey("{{Agrupacionenc}}_users","{{Agrupacionenc}}");
        $this->dropTable("{{Agrupacionenc}}");
	}
}
