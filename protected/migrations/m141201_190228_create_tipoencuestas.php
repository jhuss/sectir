<?php

class m141201_190228_create_tipoencuestas extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Tipoencuesta}}",array(
            'id' => 'pk',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Tipoencuesta}}_userid",
            "{{Tipoencuesta}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
	}

	public function down()
    {
        $this->dropForeignKey("fk_{{Tipoencuesta}}_userid","{{Tipoencuesta}}");
        $this->dropTable("{{Tipoencuesta}}");
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
