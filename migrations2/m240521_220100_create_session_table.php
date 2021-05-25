<?php

use \yii\db\Migration;

class m240521_220100_create_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('session', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'data' => $this->string(45)->comment('данные'),
            'type_session_id' => $this->integer()->notNull()->comment('ссылка на тип сессии'),
            'type_work_id' => $this->integer()->notNull()->comment('ссылка на тип работы'),
            'disc_id' => $this->integer()->notNull()->comment('ссылка на дисциплину'),
            'kurs_id' => $this->integer()->notNull()->comment('ссылка на курс'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('session', 'Таблица для хранения информации о сессиях');

        //FK
        $this->addForeignKey(
            'FK_type_session_id333111',
            'session',
            'type_session_id',
            'type_session',
            'id');
        $this->addForeignKey(
            'FK_type_work_id333111',
            'session',
            'type_work_id',
            'type_work',
            'id');
        $this->addForeignKey(
            'FK_disc_id333111',
            'session',
            'disc_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_kurs_id333111',
            'session',
            'kurs_id',
            'kurs',
            'id'
        );
        $this->addForeignKey(
            'FK_c_session_id',
            'session',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_session_id',
            'session',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_session_id',
            'session',
            'delete_by',
            'user',
            'id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('session');

        //FK
        $this->dropForeignKey('FK_type_session_id333111', 'type_session');
        $this->dropForeignKey('FK_type_work_id333111', 'type_work');
        $this->dropForeignKey('FK_disc_id333111', 'disciplins');
        $this->dropForeignKey('FK_kurs_id333111', 'kurs');
        $this->dropForeignKey('FK_c_session_id', 'user');
        $this->dropForeignKey('FK_u_session_id', 'user');
        $this->dropForeignKey('FK_d_session_id', 'user');
    }
}
