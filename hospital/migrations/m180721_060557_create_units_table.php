<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hps_units`.
 */
class m180721_060557_create_units_table extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        $this->createTable('hps_units', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('hps_units');
    }
}
