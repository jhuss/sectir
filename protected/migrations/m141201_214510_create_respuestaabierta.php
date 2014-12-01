<?php

class m141201_214510_create_respuestaabierta extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Respuestaabierta}}",array(
            'id' => 'pk',
            'pregunta_id' => 'int(11) not null',
            'user_id' => 'int(11) not null',
            'encuesta_id' => 'int(11) not null',
            'opcioncomp_id' => 'int(11)',
            'valor' => 'text not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
        ));
        $this->addForeignKey("fk_{{Respuestaabierta}}_pregunta",
            "{{Respuestaabierta}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaabierta}}_user",
            "{{Respuestaabierta}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaabierta}}_encuesta",
            "{{Respuestaabierta}}",
            "encuesta_id",
            "{{Encuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaabierta}}_opcioncomp",
            "{{Respuestaabierta}}",
            "opcioncomp_id",
            "{{Opcioncomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{Respuestaabierta}}_pregunta","{{Respuestaabierta}}");
        $this->dropForeignKey("fk_{{Respuestaabierta}}_user","{{Respuestaabierta}}");
        $this->dropForeignKey("fk_{{Respuestaabierta}}_encuesta","{{Respuestaabierta}}");
        $this->dropForeignKey("fk_{{Respuestaabierta}}_opcioncomp","{{Respuestaabierta}}");
        $this->dropTable("{{Respuestaabierta}}");
	}
}
