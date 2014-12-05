<?php

class m141201_204828_create_preguntacompuesta extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{Preguntacompuesta}}",array(
            'pregunta_id' => 'int(11) not null',
            'lft' => 'int(11) not null',
            'rgt' => 'int(11) not null',
            'PRIMARY KEY (pregunta_id)'
        ));
        $this->addForeignKey("fk_{{Preguntacompuesta}}_pregunta",
            "{{Preguntacompuesta}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
   }
	public function down()
	{
        $this->dropForeignKey("fk_{{Preguntacompuesta}}_pregunta","{{Preguntacompuesta}}");
        $this->dropTable("{{Preguntacompuesta}}");
	}
}
