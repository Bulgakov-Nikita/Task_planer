<?php

use \yii\db\Migration;

class m240521_222000_create_calendary_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('calendary', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'begin' => $this->date()->notNull()->comment('Дата начала периода'),
            'end' => $this->date()->notNull()->comment('Дата конца периода'),
            'type_periods_id' => $this->integer()->notNull()->comment('внешний ключ'),
            'kurs_id' => $this->integer()->notNull()->comment('ссылка на курсы'),
            'main_plan_id' => $this->integer()->notNull()->comment('id для учебного плана'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('calendary', 'Таблица для хранения информации о периоде');

        //FK
        $this->addForeignKey(
            'FK_type_periods_id444111',
            'calendary',
            'type_periods_id',
            'type_periods',
            'id'
        );
        $this->addForeignKey(
            'FK_kursId_calendary',
            'calendary',
            'kurs_id',
            'kurs',
            'id'
        );
        $this->addForeignKey(
            'FK_main_paln_id3445774',
            'calendary',
            'main_plan_id',
            'main_plan',
            'id'
        );
        // $this->addForeignKey(
        //     'FK_c_period_id',
        //     'period',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_period_id',
        //     'period',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_period_id',
        //     'period',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown()
    {
        $this->dropTable('calendary');
        
        //FK
        $this->dropForeigenKey('FK_type_periods_id444111', 'type_periods');
        $this->dropForeignKey('FK_kursId_calendary', 'kurs');
        $this->dropForeignKey('FK_main_paln_id3445774', 'main_plan');
    }
}