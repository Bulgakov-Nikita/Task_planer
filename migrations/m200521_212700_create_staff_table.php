<?php

use \yii\db\Migration;

class m200521_212700_create_staff_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('staff', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'FIO' => $this->string()->notNull()->comment('Фамилия имя отчество'),
            'post' => $this->string()->notNull()->comment('должность'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tyniinteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentTable('staff', 'Таблица для хранения информации о сотрудниках');
    }

    public function safeDown()
    {
        $this->dropTable('staff');
    }
}