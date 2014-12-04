<?php

class m141204_203417_create_grupo_opcioncomp extends CDbMigration
{
	public function up()
    {
        $this->createTable("{{GrupocompOpcioncomp}}",array(
            'grupocomp_id' => 'int(11) not null',
            'opcioncomp_id' => 'int(11) not null',
            'peso' => 'int(11) not null',
            'PRIMARY KEY (grupocomp_id, opcioncomp_id)'
        ));
        $this->addForeignKey("fk_{{GrupocompOpcioncomp}}_grupocomp",
            "{{GrupocompOpcioncomp}}",
            "grupocomp_id",
            "{{Grupocomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{GrupocompOpcioncomp}}_opcioncomp",
            "{{GrupocompOpcioncomp}}",
            "opcioncomp_id",
            "{{Opcioncomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }
	public function down()
	{
        $this->dropForeignKey("fk_{{GrupocompOpcioncomp}}_grupocomp","{{GrupocompOpcioncomp}}");
        $this->dropForeignKey("fk_{{GrupocompOpcioncomp}}_opcioncomp","{{GrupocompOpcioncomp}}");
        $this->dropTable("{{GrupocompOpcioncomp}}");
	}
}
