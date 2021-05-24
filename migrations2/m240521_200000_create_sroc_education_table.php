<?php

use \yii\db\Migration;

class m240521_200000_create_sroc_education_table extends Migration{
    public function safeUp(){
        $this->createTable('sroc_education',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(30)->notNull()->comment('срок обучения'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sroc_education', 'Таблица которая хранит срок обуения');
        $this->addForeignKey(
            'FK_c_sroc_education_id',
            'sroc_education',
            'create_at',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_sroc_education_id',
            'sroc_education',
            'update_at',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_sroc_education_id',
            'sroc_education',
            'delete_at',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('sroc_education');
    }
}
