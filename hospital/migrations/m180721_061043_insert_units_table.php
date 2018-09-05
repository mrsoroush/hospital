<?php

use yii\db\Migration;

/**
 * Class m180721_061043_insert_hps_units_table
 */
class m180721_061043_insert_units_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $fileName = \Yii::$app->basePath . '\sampledata\units.xlsx';
        $data = \moonland\phpexcel\Excel::import($fileName);
        foreach ($data as $val){
                $this->insert('units',$val);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180721_061043_insert_units_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180721_061043_insert_hps_units_table cannot be reverted.\n";

        return false;
    }
    */
}
