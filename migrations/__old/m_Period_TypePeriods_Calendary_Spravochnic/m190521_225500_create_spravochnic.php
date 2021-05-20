<?php
class m190521_225500_create_spravochnic_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('spravochnic',array(
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'namber_krus' => $this->integer()->notNull()->comment('Номер курса'),
            'period_id' => $this->integer()->notNull()->comment('Номер периода')
        ));


        $this->addCommentOnTable('spravochnic','График учебного процесса');
    }

    public function safeDown()
    {
        $this->dropTable('spravochnic');
    }
}