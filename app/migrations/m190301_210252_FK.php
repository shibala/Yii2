<?php

use yii\db\Migration;

/**
 * Class m190301_210252_FK
 */
class m190301_210252_FK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'user_id', $this->integer()->notNull());
        $this->addForeignKey('user_activity_FK', 'activity', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('email_ind', 'user', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_activity_FK', 'activity');
        $this->dropColumn('acivity', 'user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190301_210252_FK cannot be reverted.\n";

        return false;
    }
    */
}
