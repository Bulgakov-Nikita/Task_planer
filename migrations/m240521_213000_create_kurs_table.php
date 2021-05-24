<?php

use \yii\db\Migration;

class m240521_213000_create_kurs_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('kurs', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number_kurs' => $this->integer()->notNull()->unique()->comment('Номер курса'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('kurs', 'Таблица для хранения информации о кусах');
    }
    
    public function safeDown()
    {
        $this->dropTable('kurs');
    }
}