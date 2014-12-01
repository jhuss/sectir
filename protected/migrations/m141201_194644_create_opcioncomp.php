<?php

class m141201_194644_create_opcioncomp extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Opcioncomp}}",array(
            'id' => 'pk',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
            'grupocomp_id' => 'int(11) not null',
            'peso' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Opcioncomp}}_userid",
            "{{Opcioncomp}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

	public function down()
	{
        $this->dropForeignKey("fk_{{Opcioncomp}}_userid","{{Opcioncomp}}");
        $this->dropTable("{{Opcioncomp}}");
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
