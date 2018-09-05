<?php

use yii\db\Migration;

/**
 * Handles the creation of table `forms`.
 */
class m180725_062317_create_forms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('forms', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
        ]);

        $this->insert('forms', [
            'id' => '1',
            'name' => 'signup'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('forms');
    }
}
