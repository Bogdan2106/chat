<?php

use yii\db\Migration;

class m170803_132717_chat extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'message' => $this->string(128),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170803_132717_chat cannot be reverted.\n";

        return false;
    }

    public function down()
    {
        echo "m170803_132717_chat cannot be reverted.\n";

        return false;
    }

}
