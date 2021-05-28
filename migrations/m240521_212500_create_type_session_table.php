<?php

use \yii\db\Migration;

class m240521_212500_create_type_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_session', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('Тип сессии'),

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
        $this->addForeignKey(
            'FK_c_type_session_id',
            'type_session',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_type_session_id',
            'type_session',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_type_session_id',
            'type_session',
            'delete_by',
            'user',
            'id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('type_session');
    }
}
