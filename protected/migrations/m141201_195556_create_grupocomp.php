<?php

class m141201_195556_create_grupocomp extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Grupocomp}}",array(
            'id' => 'pk',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Grupocomp}}_userid",
            "{{Grupocomp}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

	public function down()
	{
        $this->dropForeignKey("fk_{{Grupocomp}}_userid","{{Grupocomp}}");
        $this->dropTable("{{Grupocomp}}");
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
