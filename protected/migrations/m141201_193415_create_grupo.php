<?php

class m141201_193415_create_grupo extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Grupo}}",array(
            'id' => 'pk',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Grupo}}_userid",
            "{{Grupo}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

	public function down()
	{
        $this->dropForeignKey("fk_{{Grupo}}_userid","{{Grupo}}");
        $this->dropTable("{{Grupo}}");
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
