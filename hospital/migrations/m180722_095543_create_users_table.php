<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hps_users`.
 */
class m180722_095543_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'email' => $this->string(250),
            'password' => $this->string(300),
            'role' => $this->integer(2),
            'register_date' => $this->datetime(),
            'last_login' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
