<?php

use \yii\db\Migration;

class m240521_210550_create_period_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('period', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'begin' => $this->date()->notNull()->comment('Дата начала периода'),
            'end' => $this->date()->notNull()->comment('Дата конца периода'),
            'semestr' => $this->integer()->notNull()->comment('Семестр'),
            'type_periods_id' => $this->integer()->notNull()->comment('внешний ключ'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('period', 'Таблица для хранения информации о периоде');

        //FK
        $this->addForeignKey(
            'FK_type_periods_id444111',
            'period',
            'type_periods_id',
            'type_periods',
            'id'
        );
        $this->addForeignKey(
            'FK_c_period_id',
            'period',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_period_id',
            'period',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_period_id',
            'period',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('period');
        
        //FK
        $this->dropForeigenKey('FK_type_periods_id444111', 'type_periods');
    }
}