<?php

use \yii\db\Migration;

class m240521_202100_create_groups_table extends Migration{
    public function safeUp(){
        $this->createTable('groups',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('название группы'),
            'description' => $this->text()->comment('описание группы'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('groups', 'Таблица которая хранит группу');
        $this->addForeignKey(
            'FK_c_groups_id',
            'groups',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_groups_id',
            'groups',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_groups_id',
            'groups',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('groups');
    }
}

