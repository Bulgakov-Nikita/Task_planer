<?php

use \yii\db\Migration;

class m240521_110000_create_cc2_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('cc2', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer(11)->notNull()->comment('ссылка на компетенции'),
            'comp2_id' => $this->integer(11)->notNull()->comment('ссылка на компетенции 2'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('cc2', 'Таблица для хранения информации о компетенции и компетенции 2');
        $this->addForeignKey(
            'FK_comp_id_cc2_id',
            'cc2',
            'comp_id',
            'comp',
            'id'
        );
        $this->addForeignKey(
            'FK_comp2_id_cc2_id',
            'cc2',
            'comp2_id',
            'comp2',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('cc2');
        $this->dropForeigenKey('FK_comp_id_cc2_id');
        $this->dropForeigenKey('FK_comp2_id_cc2_id');
    }
}
