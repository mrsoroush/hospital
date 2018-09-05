<?php

use yii\db\Migration;

/**
 * Handles the creation of table `passwods`.
 * Has foreign keys to the tables:
 *
 * - `users`
 */
class m180723_085927_create_passwods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('passwods', [
            'id' => $this->primaryKey(),
            'password' => $this->string(250),
            'sult' => $this->string(250),
            'pass_type' => $this->integer(1),
            'users_id' => $this->integer(7),
            'create_on' => $this->datetime(),
        ]);

        // creates index for column `users_id`
        $this->createIndex(
            'idx-passwods-users_id',
            'passwods',
            'users_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-passwods-users_id',
            'passwods',
            'users_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-passwods-users_id',
            'passwods'
        );

        // drops index for column `users_id`
        $this->dropIndex(
            'idx-passwods-users_id',
            'passwods'
        );

        $this->dropTable('passwods');
    }
}
