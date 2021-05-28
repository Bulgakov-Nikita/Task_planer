<?php

use \yii\db\Migration;

class m240521_220540_create_sprav_doljnost_prep_table extends Migration{
    public function safeUp(){
        $this->createTable('sprav_doljnost_prep',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->text()->notNull()->comment('название должности'),
            'description' => $this->text()->comment('описание должности'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_doljnost_prep', 'Таблица которая хранит должности преподавателей');

        //FK:
//        $this->addForeignKey(
//            'FK_c_groups_id',
//            'groups',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_groups_id',
//            'groups',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_groups_id',
//            'groups',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown(){
        $this->dropTable('sprav_doljnost_prep');
    }
}

