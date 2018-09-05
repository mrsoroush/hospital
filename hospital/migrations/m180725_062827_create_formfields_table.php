<?php

use yii\db\Migration;

/**
 * Handles the creation of table `formfields`.
 * Has foreign keys to the tables:
 *
 * - `forms`
 */
class m180725_062827_create_formfields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('formfields', [
            'id' => $this->primaryKey(),
            'forms_id' => $this->integer(),
            'type' => $this->string(50),
            'label' => $this->string(200),
            'rules' => $this->string(250),
        ]);

        // creates index for column `forms_id`
        $this->createIndex(
            'idx-formfields-forms_id',
            'formfields',
            'forms_id'
        );

        // add foreign key for table `forms`
        $this->addForeignKey(
            'fk-formfields-forms_id',
            'formfields',
            'forms_id',
            'forms',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `forms`
        $this->dropForeignKey(
            'fk-formfields-forms_id',
            'formfields'
        );

        // drops index for column `forms_id`
        $this->dropIndex(
            'idx-formfields-forms_id',
            'formfields'
        );

        $this->dropTable('formfields');
    }
}
