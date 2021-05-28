<?php

use \yii\db\Migration;

class m240521_211200_create_history_staj_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('history_staj', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'staj_id' => $this->integer()->notNull()->comment(''),
            'data_begin' => $this->date()->notNull()->comment(''),
            'data_end' => $this->date()->comment(''),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('period', 'Таблица для хранения информации о периоде');

        //FK
        $this->addForeignKey(
            'FK_c_history_staj',
            'history_staj',
            'staj_id',
            'staj',
            'id'
        );

        $this->addForeignKey(
            'FK_c_history_id',
            'prep_rekv',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_history_id',
            'period',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_history_id',
            'period',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('history');

        //FK
        $this->dropForeigenKey('FK_type_periods_id444111', 'type_history');
    }
}

