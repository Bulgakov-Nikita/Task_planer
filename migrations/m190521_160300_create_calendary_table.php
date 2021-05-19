<?php
class m199521_1500100_create_calendarytable extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('calendary',array(
            'id'=>$this->primaryKey()->notNull()->comment('Первичный ключ'),
            'spravochnic_id'=>$this->integer()->notNull()->comment(''),
            'period_id'=>$this->integer()->notNot()->comment('---'),
        ));

        $this->addCommentOnTable('calendary','график учебного процесса');
    }
        $this->addForeignKey(
            'spravochnic_id',
            'period_iD'
        );

    public function safeDown()
    {
        $this->dropTable('calendary');
    }
}
