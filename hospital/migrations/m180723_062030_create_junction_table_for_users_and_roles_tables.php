<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_roles`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `roles`
 */
class m180723_062030_create_junction_table_for_users_and_roles_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_roles', [
            'users_id' => $this->integer(),
            'roles_id' => $this->integer(),
            'PRIMARY KEY(users_id, roles_id)',
        ]);

        // creates index for column `users_id`
        $this->createIndex(
            'idx-users_roles-users_id',
            'users_roles',
            'users_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-users_roles-users_id',
            'users_roles',
            'users_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `roles_id`
        $this->createIndex(
            'idx-users_roles-roles_id',
            'users_roles',
            'roles_id'
        );

        // add foreign key for table `roles`
        $this->addForeignKey(
            'fk-users_roles-roles_id',
            'users_roles',
            'roles_id',
            'roles',
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
            'fk-users_roles-users_id',
            'users_roles'
        );

        // drops index for column `users_id`
        $this->dropIndex(
            'idx-users_roles-users_id',
            'users_roles'
        );

        // drops foreign key for table `roles`
        $this->dropForeignKey(
            'fk-users_roles-roles_id',
            'users_roles'
        );

        // drops index for column `roles_id`
        $this->dropIndex(
            'idx-users_roles-roles_id',
            'users_roles'
        );

        $this->dropTable('users_roles');
    }
}
