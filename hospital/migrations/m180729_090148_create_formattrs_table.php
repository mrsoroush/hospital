<?php

use yii\db\Migration;

/**
 * Handles the creation of table `formattrs`.
 * Has foreign keys to the tables:
 *
 * - `formfields`
 */
class m180729_090148_create_formattrs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('formattrs', [
            'id' => $this->primaryKey(),
            'formfields_id' => $this->integer(3),
            'value' => $this->string(20)->notNull(),
            'label' => $this->string(20)->notNull(),
        ]);

        // creates index for column `formfields_id`
        $this->createIndex(
            'idx-formattrs-formfields_id',
            'formattrs',
            'formfields_id'
        );

        // add foreign key for table `formfields`
        $this->addForeignKey(
            'fk-formattrs-formfields_id',
            'formattrs',
            'formfields_id',
            'formfields',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `formfields`
        $this->dropForeignKey(
            'fk-formattrs-formfields_id',
            'formattrs'
        );

        // drops index for column `formfields_id`
        $this->dropIndex(
            'idx-formattrs-formfields_id',
            'formattrs'
        );

        $this->dropTable('formattrs');
    }
}
