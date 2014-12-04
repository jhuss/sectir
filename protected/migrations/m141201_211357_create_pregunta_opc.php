<?php

class m141201_211357_create_pregunta_opc extends CDbMigration
{ 
	public function up()
    {
        $this->createTable("{{PreguntaOpc}}",array(
            'pregunta_id' => 'int(11) not null',
            'opcion_id' => 'int(11) not null',
            'peso' => 'int(11) not null',
            'PRIMARY KEY (pregunta_id, opcion_id)'
        ));
        $this->addForeignKey("fk_{{PreguntaOpc}}_pregunta",
            "{{PreguntaOpc}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{PreguntaOpc}}_opcion",
            "{{PreguntaOpc}}",
            "opcion_id",
            "{{Opcion}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{PreguntaOpc}}_pregunta","{{PreguntaOpc}}");
        $this->dropForeignKey("fk_{{PreguntaOpc}}_opcion","{{PreguntaOpc}}");
        $this->dropTable("{{PreguntaOpc}}");
	}
}
