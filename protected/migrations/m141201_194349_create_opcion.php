<?php

class m141201_194349_create_opcion extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Opcion}}",array(
            'id' => 'pk',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Opcion}}_userid",
            "{{Opcion}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

	public function down()
	{
        $this->dropForeignKey("fk_{{Opcion}}_userid","{{Opcion}}");
        $this->dropTable("{{Opcion}}");
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
