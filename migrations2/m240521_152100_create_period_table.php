<?php

use \yii\db\Migration;

class m240521_152100_create_period_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('period', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'begin' => $this->date()->notNull()->comment('Дата начала периода'),
            'end' => $this->date()->notNull()->comment('Дата конца периода'),
            'semestr' => $this->integer(11)->notNull()->comment('Семестр'),
            'type_periods_id' => $this->integer(11)->notNull()->comment('внешний ключ'),
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
        $this->addForeignKey(
            'FK_type_periods_id',
            'period',
            'type_periods_id',
            'type_periods',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('period');
        $this->dropForeigenKey('FK_type_periods_id');
    }
}