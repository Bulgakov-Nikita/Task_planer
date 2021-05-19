<?php
class m199521_1500100_create_spravochnic_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('sprav_kurs',array(
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number_kurs' => $this->integer()->notNull()->comment('Номерование курса'),
            'name_kurs' => $this->string()->notNull()->comment('Название курсов'),
        ));

        $this->addCommentOnTable('sprav_kurs','Для хранения списков курсов');
    }

    public function safeDown()
    {
        $this->dropTable('sprav_kurs');
    }
}