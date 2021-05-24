<?php

use \yii\db\Migration;

class m240521_110100_create_cc3_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('cc3', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer(11)->notNull()->comment('ссылка на компетенции'),
            'comp3_id' => $this->integer(11)->notNull()->comment('ссылка на компетенции 3'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('cc3', 'Таблица для хранения информации о компетенции и компетенции 3');
        $this->addForeignKey(
            'FK_comp_id_cc3_id',
            'cc3',
            'comp_id',
            'comp',
            'id'
        );
        $this->addForeignKey(
            'FK_comp3_id_cc3_id',
            'cc3',
            'comp3_id',
            'comp3',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('cc3');
        $this->dropForeigenKey('FK_comp_id_cc3_id');
        $this->dropForeigenKey('FK_comp3_id_cc3_id');
    }
}