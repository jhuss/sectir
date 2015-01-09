<?php

class m150105_220825_create_encuesta_respondida extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{Encuestarespondida}}',array(
            'id' => 'pk',
            'encuesta_id' => 'INT(11) NOT NULL',
            'user_id' => 'INT(11) NOT NULL',
            'fecha_respuesta' => 'TIMESTAMP'
        ));
        $this->addForeignKey('{{Encuestarespondida}}_encuesta',
            "{{Encuestarespondida}}",
            "encuesta_id",
            "{{Encuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey('{{Encuestarespondida}}_user',
            "{{Encuestarespondida}}",
            "user_id",
            "{{users}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
	}

	public function down()
	{
        $this->dropForeignKey("{{Encuestarespondida}}_encuesta","{{Encuestarespondida}}");
        $this->dropForeignKey("{{Encuestarespondida}}_user","{{Encuestarespondida}}");
        $this->dropTable("{{Encuestarespondida}}");
	}
}
