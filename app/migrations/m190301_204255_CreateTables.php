<?php

use yii\db\Migration;

/**
 * Class m190301_204255_CreateTables
 */
class m190301_204255_CreateTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
           'id' => $this->primaryKey(),
           'email' => $this->string(150)->notNull(),
           'password_hash' => $this->string(300)->notNull(),
           'token' => $this->string(150),
           'name' => $this->string(150),
           'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'date_start' => $this->date()->notNull(),
            'date_end' => $this->date(),
            'user_notification' => $this->boolean()->notNull()->defaultValue(0),
            'is_blocked' => $this->boolean()->notNull()->defaultValue(0),
            'is_repeat' => $this->boolean()->notNull()->defaultValue(0),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190301_204255_CreateTables cannot be reverted.\n";

        return false;
    }
    */
}
