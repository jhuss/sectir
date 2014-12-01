<?php

class m141201_192033_create_encuesta extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Encuesta}}",array(
            'id' => 'pk',
            'tipoencuesta_id' => 'int(11) not null',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'fecha_inicial' => "datetime",
            'fecha_final' => "datetime",
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Encuesta}}_userid",
            "{{Encuesta}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Encuesta}}_tipoencuesta",
            "{{Encuesta}}",
            "tipoencuesta_id",
            "{{Tipoencuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
	}

	public function down()
	{
        $this->dropForeignKey("fk_{{Encuesta}}_userid","{{Encuesta}}");
        $this->dropForeignKey("fk_{{Encuesta}}_tipoencuesta","{{Encuesta}}");
        $this->dropTable("{{Encuesta}}");
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
