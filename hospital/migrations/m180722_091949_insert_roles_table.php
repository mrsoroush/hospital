<?php

use yii\db\Migration;

/**
 * Class m180722_091949_insert_hps_roles_table
 */
class m180722_091949_insert_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('roles',['id', 'role'],[
                ['1', 'Super Administrator'],
                ['2', 'Author'],
                ['3', 'Registered User']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180722_091949_insert_hps_roles_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180722_091949_insert_hps_roles_table cannot be reverted.\n";

        return false;
    }
    */
}
