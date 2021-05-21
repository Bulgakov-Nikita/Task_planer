<?php

use \yii\db\Migration;

class m210521_193300_create_session_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('session', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'data' => $this->char(45)->notNull()->comment('данные'),
            'type_session_id' => $this->integer(11)->notNull()->comment('ссылка на тип сессии'),
            'type_work_id' => $this->integer(11)->notNull()->comment('ссылка на тип работы'),
            'plan_id' => $this->integer(11)->notNull()->comment('ссылка на план'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tyniinteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('session', 'Таблица для хранения информации о сессиях');

        $this->addForeignKey(
            'FK_type_session_id',
            'session',
            'type_session_id',
            'type_session',
            'id');
        $this->addForeignKey(
            'FK_type_work_id',
            'session',
            'type_work_id',
            'type_work',
            'id');
        $this->addForeignKey(
            'FK_plan_id',
            'session',
            'plan_id',
            'plan',
            'id');

    }

    public function safeDown()
    {
        $this->dropTable('session');
        $this->dropForeignKey('FK_type_session_id');
        $this->dropForeignKey('FK_type_work_id');
        $this->dropForeignKey('FK_plan_id');
    }
}
