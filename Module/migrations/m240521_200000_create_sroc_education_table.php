<?php

use \yii\db\Migration;

class m240521_200000_create_sroc_education_table extends Migration{
    public function safeUp(){
        $this->createTable('sroc_education',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(10)->notNull()->comment('срок обучения'),
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sroc_education', 'Таблица которая хранит срок обуения');
        $this->addForeignKey(
            'FK_c_sroc_education_id',
            'sroc_education',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_sroc_education_id',
            'sroc_education',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_sroc_education_id',
            'sroc_education',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('sroc_education');
    }
}
