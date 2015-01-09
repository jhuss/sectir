<?php

class m150106_153342_encuesta_agrupacionid extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{Encuesta}}", "agrupacionenc_id", "INT(11)");
        $this->addForeignKey("fk_{{Encuesta}}_agrupacionenc","{{Encuesta}}",
            "agrupacionenc_id",
            "{{Agrupacionenc}}",
            "id");
	}

	public function down()
	{
        $this->dropForeignKey("fk_{{Encuesta}}_agrupacionenc","{{Encuesta}}");
        $this->dropColumn("{{Encuesta}}","agrupacionenc_id");
	}
}
