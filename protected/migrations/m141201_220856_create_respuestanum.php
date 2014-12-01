<?php

class m141201_220856_create_respuestanum extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Respuestanum}}",array(
            'id' => 'pk',
            'pregunta_id' => 'int(11) not null',
            'user_id' => 'int(11) not null',
            'encuesta_id' => 'int(11) not null',
            'opcioncomp_id' => 'int(11)',
            'valor' => 'int(11) not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
        ));
        $this->addForeignKey("fk_{{Respuestanum}}_pregunta",
            "{{Respuestanum}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestanum}}_user",
            "{{Respuestanum}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestanum}}_encuesta",
            "{{Respuestanum}}",
            "encuesta_id",
            "{{Encuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestanum}}_opcioncomp",
            "{{Respuestanum}}",
            "opcioncomp_id",
            "{{Opcioncomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{Respuestanum}}_pregunta","{{Respuestanum}}");
        $this->dropForeignKey("fk_{{Respuestanum}}_user","{{Respuestanum}}");
        $this->dropForeignKey("fk_{{Respuestanum}}_encuesta","{{Respuestanum}}");
        $this->dropForeignKey("fk_{{Respuestanum}}_opcioncomp","{{Respuestanum}}");
        $this->dropTable("{{Respuestanum}}");
	}
}
