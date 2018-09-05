<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hps_roles`.
 */
class m180722_091836_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hps_roles', [
            'id' => $this->primaryKey(),
            'role' => $this->string(30),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('hps_roles');
    }
}
