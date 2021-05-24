<?php

use \yii\db\Migration;

class m240521_222500_create_calendary_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('calendary', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'kurs_id' => $this->integer()->notNull()->comment('Ссылка на курсы'),
            'period_id' => $this->integer()->notNull()->comment('Ссылка на периоды'),
            'main_plan_id' => $this->integer()->notNull()->comment('ссылка на главную таблицу'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('calendary', 'Таблица для хранения информации о календарь');

        //FK
        $this->addForeignKey(
            'FK_kurs_id_calendary_id',
            'calendary',
            'kurs_id',
            'kurs',
            'id'
        );
        $this->addForeignKey(
            'FK_periods_id_calendary_id',
            'calendary',
            'period_id',
            'period',
            'id'
        );
        $this->addForeignKey(
            'FK_main_plan_id_calendary_id',
            'calendary',
            'main_plan_id',
            'main_plan',
            'id'
        );
        $this->addForeignKey(
            'FK_c_calendary_id',
            'calendary',
            'create_at',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_calendary_id',
            'calendary',
            'update_at',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_calendary_id',
            'calendary',
            'delete_at',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('calendary');

        //FK
        $this->dropForeigenKey('FK_kurs_id_calendary_id', 'kurs');
        $this->dropForeigenKey('FK_periods_id_calendary_id', 'period');
        $this->dropForeigenKey('FK_main_plan_id_calendary_id', 'main_plan');
    }
}