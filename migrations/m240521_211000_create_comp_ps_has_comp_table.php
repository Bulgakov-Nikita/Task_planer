<?php

use \yii\db\Migration;

class m240521_211000_create_comp_ps_has_comp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comp_ps_has_comp', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer()->notNull()->comment('ссылка на компетенции'),
            'comp_ps_id' => $this->integer()->notNull()->comment('ссылка на компетенции 3'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('comp_ps_has_comp', 'Таблица для хранения информации о компетенции и компетенции 3');

        //FK
        $this->addForeignKey(
            'FK_comp_id_cc3_id',
            'comp_ps_has_comp',
            'comp_id',
            'comp',
            'id'
        );
        $this->addForeignKey(
            'FK_comp3_id_cc3_id',
            'comp_ps_has_comp',
            'comp_ps_id',
            'comp_ps',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('comp_ps_has_comp');

        //FK
        $this->dropForeigenKey('FK_comp_id_cc3_id', 'comp_id');
        $this->dropForeigenKey('FK_comp3_id_cc3_id', 'comp_ps');
    }
}