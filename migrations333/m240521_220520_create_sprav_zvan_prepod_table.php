<?php

use \yii\db\Migration;

class m240521_220520_create_sprav_zvan_prepod_table extends Migration{
    public function safeUp(){
        $this->createTable('sprav_zvan_prepod',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(100)->notNull()->comment('учёное звание'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_zvan_prepod', 'Таблица которая хранит учёные звания');

        //FK:
//        $this->addForeignKey(
//            'FK_c_sroc_education_id',
//            'sroc_education',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_sroc_education_id',
//            'sroc_education',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_sroc_education_id',
//            'sroc_education',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown(){
        $this->dropTable('sprav_zvan_prepod');
    }
}
