<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hps_contents`.
 * Has foreign keys to the tables:
 *
 * - `units`
 */
class m180721_100134_create_contents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hps_contents', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250)->notNull(),
            'body' => $this->text(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'published' => $this->boolean(),
            'unit_id' => $this->integer(),
            'auther' => $this->integer(),
        ]);

        // creates index for column `unit_id`
        $this->createIndex(
            'idx-hps_contents-unit_id',
            'hps_contents',
            'unit_id'
        );

        // add foreign key for table `units`
        $this->addForeignKey(
            'fk-hps_contents-unit_id',
            'hps_contents',
            'unit_id',
            'units',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `units`
        $this->dropForeignKey(
            'fk-hps_contents-unit_id',
            'hps_contents'
        );

        // drops index for column `unit_id`
        $this->dropIndex(
            'idx-hps_contents-unit_id',
            'hps_contents'
        );

        $this->dropTable('hps_contents');
    }
}
