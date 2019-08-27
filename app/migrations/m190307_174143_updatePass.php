<?php

use yii\db\Migration;

/**
 * Class m190307_174143_updatePass
 */
class m190307_174143_updatePass extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->update('users', ['password_hash' => \Yii::$app->security->generatePasswordHash(1111)], 'id = 1');
        $this->update('users', ['password_hash' => \Yii::$app->security->generatePasswordHash(2222)], 'id = 2');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        $this->update('users', ['password_hash' => 1111], 'id = 1');
        $this->update('users', ['password_hash' => 2222], 'id = 2');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190307_174143_updatePass cannot be reverted.\n";

        return false;
    }
    */
}
