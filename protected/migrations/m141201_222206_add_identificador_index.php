<?php

class m141201_222206_add_identificador_index extends CDbMigration
{
	public function up()
    {
        $this->createIndex("idx_{{Grupo}}_identificador","{{Grupo}}","identificador",true);
        $this->createIndex("idx_{{Grupocomp}}_identificador","{{Grupocomp}}","identificador",true);
        $this->createIndex("idx_{{Pregunta}}_identificador","{{Pregunta}}","identificador",true);
        $this->createIndex("idx_{{Opcioncomp}}_identificador","{{Opcioncomp}}","identificador",true);
        $this->createIndex("idx_{{Opcion}}_identificador","{{Opcion}}","identificador",true);
        $this->createIndex("idx_{{Tipoencuesta}}_identificador","{{Tipoencuesta}}","identificador",true);
	}

	public function down()
    {
        $this->dropIndex("idx_{{Grupo}}_identificador","{{Grupo}}");
        $this->dropIndex("idx_{{Grupocomp}}_identificador","{{Grupocomp}}");
        $this->dropIndex("idx_{{Pregunta}}_identificador","{{Pregunta}}");
        $this->dropIndex("idx_{{Opcioncomp}}_identificador","{{Opcioncomp}}");
        $this->dropIndex("idx_{{Opcion}}_identificador","{{Opcion}}");
        $this->dropIndex("idx_{{Tipoencuesta}}_identificador","{{Tipoencuesta}}");
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
