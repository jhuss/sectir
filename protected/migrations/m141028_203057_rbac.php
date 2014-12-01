<?php

class m141028_203057_rbac extends CDbMigration
{
    /*
	public function up()
    {
    }*/
/*
	public function down()
	{
		echo "m141028_203057_rbac does not support migration down.\n";
		return false;
    }
 */

	
	// Use safeUp/safeDown to do migration with transaction
	public function up()
    {
/*        $sql = <<<EOF
    create table {{AuthItem}}
    (
       name                 varchar(64) not null,
       type                 integer not null,
       description          text,
       bizrule              text,
       data                 text,
       primary key (name)
    );
     
    create table {{AuthItemChild}}
    (
       parent               varchar(64) not null,
       child                varchar(64) not null,
       primary key (parent,child),
       foreign key (parent) references {{AuthItem}} (name) on delete cascade on update cascade,
       foreign key (child) references {{AuthItem}} (name) on delete cascade on update cascade
    );
     
    create table {{AuthAssignment}}
    (
       itemname             varchar(64) not null,
       userid               varchar(64) not null,
       bizrule              text,
       data                 text,
       primary key (itemname,userid),
       foreign key (itemname) references {{AuthItem}} (name) on delete cascade on update cascade
    );
EOF;
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $command->execute();
 */
        $this->createTable('{{AuthItem}}',array(
            'name' => 'varchar(64) not null',
            'type' => 'integer not null',
            'description' => 'text',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (name)'
        ));

        $this->createTable('{{AuthItemChild}}',array(
            'parent' => 'varchar(64) not null',
            'child' => 'varchar(64) not null',
            'PRIMARY KEY (parent, child)'
        ));
        $this->createTable('{{AuthAssignment}}',array(
            'itemname' => 'varchar(64) not null',
            'userid' => 'varchar(64) not null',
            'data' => 'text',
            'bizrule' => 'text',
            'PRIMARY KEY (itemname, userid)'));
        // Aquí las tablas ya fueron añadidas
        $this->addForeignKey("fk_{{authitemchild}}_parent",
            "{{AuthItemChild}}",
            "parent",
            "{{AuthItem}}",
            "name",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{authitem}}_child",
            "{{AuthItemChild}}",
            "child",
            "{{AuthItem}}",
            "name",
            "CASCADE",
            "CASCADE"
        );
        $this->addForeignKey("fk_{{authassignment}}_itemname",
            "{{AuthAssignment}}",
            "itemname",
            "{{AuthItem}}",
            "name",
            "CASCADE",
            "CASCADE"
        );
	}

	public function safeDown()
    {
        $this->dropForeignKey("fk_{{authitemchild}}_parent","{{AuthItemChild}}");
        $this->dropForeignKey("fk_{{authitem}}_child","{{AuthItemChild}}");
        $this->dropForeignKey("fk_{{authassignment}}_itemname","{{AuthAssignment}}");
        $this->dropTable("{{AuthItem}}");
        $this->dropTable("{{AuthItemChild}}");
        $this->dropTable("{{AuthAssignment}}");
	}
	
}
