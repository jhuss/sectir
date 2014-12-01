<?php

class m141201_205804_create_tipoencuesta_grupo extends CDbMigration
{ 
	public function up()
    {
        $this->createTable("{{TipoencuestaGrupo}}",array(
            'tipoencuesta_id' => 'int(11) not null',
            'grupo_id' => 'int(11) not null',
            'peso' => 'int(11) not null',
            'PRIMARY KEY (tipoencuesta_id, grupo_id)'
        ));
        $this->addForeignKey("fk_{{TipoencuestaGrupo}}_tipoencuesta",
            "{{TipoencuestaGrupo}}",
            "tipoencuesta_id",
            "{{Tipoencuesta}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{TipoencuestaGrupo}}_grupo",
            "{{TipoencuestaGrupo}}",
            "grupo_id",
            "{{Grupo}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{TipoencuestaGrupo}}_tipoencuesta","{{TipoencuestaGrupo}}");
        $this->dropForeignKey("fk_{{TipoencuestaGrupo}}_grupo","{{TipoencuestaGrupo}}");
        $this->dropTable("{{TipoencuestaGrupo}}");
	}
}
