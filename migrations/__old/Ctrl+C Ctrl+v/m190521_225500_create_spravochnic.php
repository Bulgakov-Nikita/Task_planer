<?php
class m190521_225500_create_spravochnic_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('spravochnic',array(
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'namber_krus' => $this->integer()->notNull()->comment('Номер курса'),
            'period_id' => $this->integer()->notNull()->comment('Номер периода'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ));


        $this->addCommentOnTable('spravochnic','График учебного процесса');
    }

    public function safeDown()
    {
        $this->dropTable('spravochnic');
    }
}
