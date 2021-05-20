<?php
class m190521_224600_create_calendary_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('calendary',array(
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'spravochnic_id' => $this->integer()->notNull()->comment(''),
            'period_id' => $this->integer()->notNull()->comment(''),
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
            'spravochnic_id',
            'period_id'
        );

        $this->addCommentOnTable('calendary','График учебного процесса');
    }

    public function safeDown()
    {
        $this->dropTable('calendary');
    }
}
