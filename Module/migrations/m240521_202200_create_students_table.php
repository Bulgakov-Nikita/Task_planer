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
            'seria' => $this->string(45)->notNull()->comment('серия паспорта'),
            'groups_id'=> $this->integer()->notNull()->comment('номер группы'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);

        $this->addCommentOnTable('students', 'Таблица которая хранит информацию о студентах');
        $this->addForeignKey(
            'FK_c_students_id',
            'groups',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_students_id',
            'groups',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_students_id',
            'groups',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('students');
    }
}
