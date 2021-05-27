<?php

use \yii\db\Migration;

class m240521_202100_create_groups_table extends Migration{
    public function safeUp(){
        $this->createTable('groups',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('название группы'),
            'description' => $this->text()->comment('описание группы'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('groups', 'Таблица которая хранит группу');

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
        $this->dropTable('groups');
    }
}

