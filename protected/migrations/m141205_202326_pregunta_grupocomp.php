<?php

class m141205_202326_pregunta_grupocomp extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{PreguntaGrupocomp}}",array(
            'pregunta_id' => 'int(11) not null',
            'grupocomp_id' => 'int(11) not null',
            'peso' => 'int(11) not null',
            'PRIMARY KEY(pregunta_id, grupocomp_id)'
        ));
        $this->addForeignKey("fk_{{PreguntaGrupocomp}}_pregunta",
            "{{PreguntaGrupocomp}}",
            "pregunta_id",
            "{{Pregunta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{PreguntaGrupocomp}}_grupocomp",
            "{{PreguntaGrupocomp}}",
            "grupocomp_id",
            "{{Grupocomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{PreguntaGrupocomp}}_pregunta","{{PreguntaGrupocomp}}");
        $this->dropForeignKey("fk_{{PreguntaGrupocomp}}_grupocomp","{{PreguntaGrupocomp}}");
        $this->dropTable("{{PreguntaGrupocomp}}");
	}
}
