<?php

use \yii\db\Migration;

class m240521_220500_create_dc_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('dc', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer()->notNull()->comment('ссылка на компетенции'),
            'disciplins_id' => $this->integer()->notNull()->comment('ссылка на компетенции 2'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('dc', 'Таблица для хранения информации о компетенции и компетенции 2');

        //FK
        $this->addForeignKey(
            'FK_comp_id_cc2_id',
            'dc',
            'comp_id',
            'comp',
            'id'
        );
        $this->addForeignKey(
            'FK_comp2_id_cc2_id',
            'dc',
            'disciplins_id',
            'disciplins',
            'id'
        );
        // $this->addForeignKey(
        //     'FK_c_dc_id',
        //     'dc',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_dc_id',
        //     'dc',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_dc_id',
        //     'dc',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown()
    {
        $this->dropTable('dc');

        //FK
        $this->dropForeigenKey('FK_comp_id_cc2_id', 'comp');
        $this->dropForeigenKey('FK_comp2_id_cc2_id', 'disciplins');
    }
}
