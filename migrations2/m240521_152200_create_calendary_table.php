<?php

use \yii\db\Migration;

class m240521_152200_create_calendary_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('calendary', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'kurs_id' => $this->date()->notNull()->comment('Ссылка на курсы'),
            'periods_id' => $this->date()->notNull()->comment('Ссылка на периоды'),
            'main_plan_id' => $this->integer(11)->notNull()->comment('ссылка на главную таблицу'),
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
            'periods_id',
            'periods',
            'id'
        );
        $this->addForeignKey(
            'FK_main_plan_id_calendary_id',
            'calendary',
            'main_plan_id',
            'main_plan',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('calendary');
        $this->dropForeigenKey('FK_kurs_id_calendary_id');
        $this->dropForeigenKey('FK_periods_id_calendary_id');
        $this->dropForeigenKey('FK_main_plan_id_calendary_id');
    }
}