<?php

use yii\db\Migration;

/**
 * Class m190301_212548_inserts
 */
class m190301_212548_inserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('user', ['id','email', 'password_hash'],
           [
               [1, 'email@mail.com', 1111],
               [2, 'email2@mail.com', 2222]
            ]);

        $this->batchInsert('activity', ['title','date_start', 'user_id', 'user_notification'],
            [
                ['Activity 1', date('Y-m-d H:i:s'), 1, 0],
                ['Activity 2', date('Y-m-d H:i:s'), 1, 0],
                ['Activity 3', date('Y-m-d H:i:s'), 1, 0],
                ['Activity 4', date('Y-m-d H:i:s'), 2, 0],
                ['Activity 6', date('Y-m-d H:i:s'), 2, 0],
                ['Activity 7', date('Y-m-d H:i:s'), 2, 0],
                ['Activity 8', date('Y-m-d H:i:s'), 2, 0],
                ['Activity 9', date('Y-m-d H:i:s'), 2, 0],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user');
        $this->delete('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190301_212548_inserts cannot be reverted.\n";

        return false;
    }
    */
}
