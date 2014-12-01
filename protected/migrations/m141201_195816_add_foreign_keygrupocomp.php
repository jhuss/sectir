<?php

class m141201_195816_add_foreign_keygrupocomp extends CDbMigration
{
	public function up()
	{
        $this->addForeignKey("fk_{{Opcioncomp}}_grupocomp_id",
            "{{Opcioncomp}}",
            "grupocomp_id",
            "{{Grupocomp}}",
            "id",
            "CASCADE",
            "CASCADE"
        );
	}

	public function down()
	{
        $this->dropForeignKey("fk_{{Opcioncomp}}_grupocomp_id","{{Opcioncomp}}");
		echo "m141201_195816_add_foreign_keygrupocomp does not support migration down.\n";
//		return false;
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
