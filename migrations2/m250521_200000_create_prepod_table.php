<?php

use \yii\db\Migration;

class m250521_200000_create_prepod_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prepod', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'FIO' => $this->string()->notNull()->comment('тип формы'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prepod', 'Таблица для хранения информации о типах формы');
    }

    public function safeDown()
    {
        $this->dropTable('prepod');
    }
}
