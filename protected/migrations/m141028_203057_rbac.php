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
	public function safeUp()
    {
        $sql = <<<EOF
    create table AuthItem
    (
       name                 varchar(64) not null,
       type                 integer not null,
       description          text,
       bizrule              text,
       data                 text,
       primary key (name)
    );
     
    create table AuthItemChild
    (
       parent               varchar(64) not null,
       child                varchar(64) not null,
       primary key (parent,child),
       foreign key (parent) references AuthItem (name) on delete cascade on update cascade,
       foreign key (child) references AuthItem (name) on delete cascade on update cascade
    );
     
    create table AuthAssignment
    (
       itemname             varchar(64) not null,
       userid               varchar(64) not null,
       bizrule              text,
       data                 text,
       primary key (itemname,userid),
       foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
    );
EOF;
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $command->execute();
	}

	public function safeDown()
    {
        $this->dropTable("AuthItem");
        $this->dropTable("AuthItemChild");
        $this->dropTable("AuthAssignment");
	}
	
}
