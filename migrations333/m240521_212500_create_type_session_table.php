<?php

use \yii\db\Migration;

class m240521_212500_create_type_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_session', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('Тип сессии'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_session', 'Таблица для хранения информации о Типах сессии');

        //FK:
        // $this->addForeignKey(
        //     'FK_c_type_session_id',
        //     'type_session',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_type_session_id',
        //     'type_session',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_type_session_id',
        //     'type_session',
        //     'delete_by',
        //     'user',
        //     'id'
        // );

    }

    public function safeDown()
    {
        $this->dropTable('type_session');
    }
}
