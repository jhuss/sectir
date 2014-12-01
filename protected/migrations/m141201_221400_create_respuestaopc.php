<?php

class m141201_221400_create_respuestaopc extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Respuestaopc}}",array(
            'id' => 'pk',
            'pregunta_id' => 'int(11) not null',
            'user_id' => 'int(11) not null',
            'encuesta_id' => 'int(11) not null',
            'opcioncomp_id' => 'int(11)',
            'opcion_id' => 'int(11)',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
        ));
        $this->addForeignKey("fk_{{Respuestaopc}}_pregunta",
            "{{Respuestaopc}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaopc}}_user",
            "{{Respuestaopc}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaopc}}_encuesta",
            "{{Respuestaopc}}",
            "encuesta_id",
            "{{Encuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaopc}}_opcioncomp",
            "{{Respuestaopc}}",
            "opcioncomp_id",
            "{{Opcioncomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaopc}}_opcion",
            "{{Respuestaopc}}",
            "opcion_id",
            "{{Opcion}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{Respuestaopc}}_pregunta","{{Respuestaopc}}");
        $this->dropForeignKey("fk_{{Respuestaopc}}_user","{{Respuestaopc}}");
        $this->dropForeignKey("fk_{{Respuestaopc}}_encuesta","{{Respuestaopc}}");
        $this->dropForeignKey("fk_{{Respuestaopc}}_opcioncomp","{{Respuestaopc}}");
        $this->dropForeignKey("fk_{{Respuestaopc}}_opcion","{{Respuestaopc}}");
        $this->dropTable("{{Respuestaopc}}");
	}
}
