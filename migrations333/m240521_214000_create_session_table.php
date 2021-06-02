<?php

use \yii\db\Migration;

class m240521_214000_create_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('session', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'value' => $this->float()->notNull()->comment('данные'),
            'type_session_id' => $this->integer()->notNull()->comment('ссылка на тип сессии'),
            'type_work_id' => $this->integer()->notNull()->comment('ссылка на тип работы'),
            'disciplins_id' => $this->integer()->notNull()->comment('ссылка на дисципоины'),
            'kurs_id' => $this->integer()->notNull()->comment('ссылка на курсы'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
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
            'FK_type_form_id32341',
            'session',
            'disciplins_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_kursId_session',
            'session',
            'kurs_id',
            'kurs',
            'id'
        );

        // $this->addForeignKey(
        //     'FK_c_session_id',
        //     'session',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_session_id',
        //     'session',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_session_id',
        //     'session',
        //     'delete_by',
        //     'user',
        //     'id'
        // );

    }

    public function safeDown()
    {
        $this->dropTable('session');

        //FK
        $this->dropForeignKey('FK_type_session_id333111', 'type_session');
        $this->dropForeignKey('FK_type_work_id333111', 'type_work');
        $this->dropForeignKey('FK_type_form_id32341', 'disciplins');
        $this->dropForeignKey('FK_kursId_session', 'kurs');

    }
}
