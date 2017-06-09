<?php

use yii\db\Migration;
use yii\db\Schema;

class m170517_214336_extend_status_table_for_created_by extends Migration
{
    public function up()
    {
      //ALTER TABLE `status` ADD FOREIGN KEY(`created_by`)REFERENCES user(id);
      $tableOptions = null;
      //if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      //}
      //$this->addColumn('{{%status}}','created_by',Schema::TYPE_INTEGER.' NOT NULL');
      $this->addForeignKey('fk_status_created_by', '{{%status}}', 'created_by', '{{%user2}}', 'id', 'CASCADE', 'CASCADE');

      /*$this->addForeignKey(
          'fk_status_created_by',
          'status',
          'created_by',
          'user',
          'id',
          'CASCADE'
      );*/
    }

    public function down()
    {
      $this->dropForeignKey('fk_status_created_by','{{%status}}');
      $this->dropColumn('{{%status}}','created_by');
    }


    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
