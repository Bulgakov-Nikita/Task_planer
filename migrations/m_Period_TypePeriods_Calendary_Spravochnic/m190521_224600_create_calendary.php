<?php
class m190521_224600_create_calendary_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('calendary',array(
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'spravochnic_id' => $this->integer()->notNull()->comment(''),
            'period_id' => $this->integer()->notNull()->comment('')
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