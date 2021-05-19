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
            'type_periods_id'=>$this->integer()->notNull()->comment('')
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
