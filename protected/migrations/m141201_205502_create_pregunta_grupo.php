<?php

class m141201_205502_create_pregunta_grupo extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{PreguntaGrupo}}",array(
            'pregunta_id' => 'int(11) not null',
            'grupo_id' => 'int(11) not null',
            'peso' => 'int(11) not null',
            'PRIMARY KEY(pregunta_id, grupo_id)'
        ));
        $this->addForeignKey("fk_{{PreguntaGrupo}}_pregunta",
            "{{PreguntaGrupo}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{PreguntaGrupo}}_grupo",
            "{{PreguntaGrupo}}",
            "grupo_id",
            "{{Grupo}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{PreguntaGrupo}}_pregunta","{{PreguntaGrupo}}");
        $this->dropForeignKey("fk_{{PreguntaGrupo}}_grupo","{{PreguntaGrupo}}");
        $this->dropTable("{{PreguntaGrupo}}");
	}
}
