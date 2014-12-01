<?php

class m141201_200800_create_pregunta extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Pregunta}}",array(
            'id' => 'pk',
            'enunciado' => 'varchar(256) not null',
            'identificador' => 'varchar(32) not null',
            'tipo' => 'varchar(32) not null',
            'compuesta' => 'tinyint(1) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
            'user_id' => 'int(11) not null',
        ));
        $this->addForeignKey("fk_{{Pregunta}}_userid",
            "{{Pregunta}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->createIndex("idx_{{Pregunta}}_tipo","{{Pregunta}}","tipo");
    }

	public function down()
	{
        $this->dropIndex("idx_{{Pregunta}}_tipo","{{Pregunta}}");
        $this->dropForeignKey("fk_{{Pregunta}}_userid","{{Pregunta}}");
        $this->dropTable("{{Pregunta}}");
	}
}
