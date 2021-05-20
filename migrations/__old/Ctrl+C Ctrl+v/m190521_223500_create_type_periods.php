<?php
class m190521_223500_create_type_periods_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('type_periods',array(
            'id'=>$this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name'=>$this->string(45)->notNull()->comment('Название периода'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ));

        $this->addCommentOnTable('type_period','тип периода');
    }

    public function safeDown()
    {
        $this->dropTable('type_periods');
    }
}
