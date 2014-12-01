<?php

class m141201_215348_create_respuestaano extends CDbMigration
{ 
	public function up()
    {
        $this->createTable("{{Respuestaano}}",array(
            'id' => 'pk',
            'pregunta_id' => 'int(11) not null',
            'user_id' => 'int(11) not null',
            'encuesta_id' => 'int(11) not null',
            'opcioncomp_id' => 'int(11)',
            'ano' => 'smallint(5) unsigned not null',
            'valor' => 'text not null',
            'creado_en' => 'timestamp',
            'actualizado_en' => 'timestamp',
        ));
        $this->addForeignKey("fk_{{Respuestaano}}_pregunta",
            "{{Respuestaano}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaano}}_user",
            "{{Respuestaano}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaano}}_encuesta",
            "{{Respuestaano}}",
            "encuesta_id",
            "{{Encuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{Respuestaano}}_opcioncomp",
            "{{Respuestaano}}",
            "opcioncomp_id",
            "{{Opcioncomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{Respuestaano}}_pregunta","{{Respuestaano}}");
        $this->dropForeignKey("fk_{{Respuestaano}}_user","{{Respuestaano}}");
        $this->dropForeignKey("fk_{{Respuestaano}}_encuesta","{{Respuestaano}}");
        $this->dropForeignKey("fk_{{Respuestaano}}_opcioncomp","{{Respuestaano}}");
        $this->dropTable("{{Respuestaano}}");
	}
}
