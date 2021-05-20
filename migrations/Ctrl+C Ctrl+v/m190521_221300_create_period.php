<?php
class m190521_221300_create_period_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('period',array(
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'begin'=>$this->date()->notNull()->comment('Начальная дата'),
            'end'=>$this->date()->notNull()->comment('Конечная дата'),
            'semestr'=>$this->integer()->notNull()->comment('Определяет какой сейчас симестр по счету'),
            'type_periods_id'=>$this->integer()->notNull()->comment(''),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ));

        $this->addForeignKey(
            'type_periods_id'
        );

        $this->addCommentOnTable('period','Для хранения списков курсов');
    }

    public function safeDown()
    {
        $this->dropTable('period');
    }
}