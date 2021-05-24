<?php

use \yii\db\Migration;

class m200521_215100_create_sroc_education_table extends Migration{
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
    }

    public function safeDown(){
        $this->dropTable('sroc_education');
    }
}
