<?php

use \yii\db\Migration;

class m240521_110200_create_pc3_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('pc3', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp3_id' => $this->integer(11)->notNull()->comment('ссылка на компетенцию 3'),
            'prof_standart_id' => $this->integer(11)->notNull()->comment('ссылка на проф стандарт'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('pc3', 'Таблица для хранения информации о проф стандарте и компетенции 3');
        $this->addForeignKey(
            'FK_comp3_id_pc3_id',
            'pc3',
            'comp3_id',
            'comp3',
            'id'
        );
        $this->addForeignKey(
            'FK_prof_standart_id_pc3_id',
            'pc3',
            'prof_standart_id',
            'prof_standart',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('pc3');
        $this->dropForeignKey('FK_comp3_id_pc3_id');
        $this->dropForeignKey('FK_prof_standart_id_pc3_id');
    }
}