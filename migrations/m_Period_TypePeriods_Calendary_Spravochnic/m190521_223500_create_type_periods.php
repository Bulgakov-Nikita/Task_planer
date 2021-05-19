<?php
class m190521_223500_create_type_periods_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('type_periods',array(
            'id'=>$this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name'=>$this->string(45)->notNull()->comment('Название периода')
        ));

        $this->addCommentOnTable('type_period','тип периода');
    }

    public function safeDown()
    {
        $this->dropTable('type_periods');
    }
}