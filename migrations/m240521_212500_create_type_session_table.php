<?php

use \yii\db\Migration;

class m240521_212500_create_type_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_session', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->unique()->comment('Тип сессии'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_session', 'Таблица для хранения информации о Типах сессии');

    }

    public function safeDown()
    {
        $this->dropTable('type_session');
    }
}
