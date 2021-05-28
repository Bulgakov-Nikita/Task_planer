<?php

use \yii\db\Migration;

class m240521_211345_create_kurs_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('kurs', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number_kurs' => $this->integer()->notNull()->comment('Номер курса'),

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
        $this->addForeignKey(
            'FK_c_kurs_id',
            'kurs',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_kurs_id',
            'kurs',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_kurs_id',
            'kurs',
            'delete_by',
            'user',
            'id'
        );
    }
    
    public function safeDown()
    {
        $this->dropTable('kurs');
    }
}