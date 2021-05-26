<?php

use \yii\db\Migration;

class m240521_202200_create_students_table extends Migration{
    public function safeUp(){
        $this->createTable('students',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'f'=>$this->string(100)->notNull()->comment('Ф'),
            'i'=>$this->string(100)->notNull()->comment('и'),
            'o'=>$this->string(100)->notNull()->comment('о'),
            '№'=>$this->string(100)->notNull()->comment('номер паспорта'),
            'seria'=>$this->string(45)->notNull()->coment('серия паспорта'),
            'groups_id'=>integer()->notNull()->comment('номер группы'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);

        $this->addForeignKey('groups_id');

        $this->addCommentOnTable('students', 'Таблица которая хранит информацию о студентах');
        $this->addForeignKey(
            'FK_c_students_id',
            'groups',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_students_id',
            'groups',
            'update_by',
            'user',
            'id',
            'gr'
        );
        $this->addForeignKey(
            'FK_d_students_id',
            'groups',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('students');
    }
}

