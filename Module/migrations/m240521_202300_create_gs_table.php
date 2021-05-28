<?php

use \yii\db\Migration;

class m240521_202300_create_gs_table extends Migration{
    public function safeUp(){
        $this->createTable('gs',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'groups_id' => $this->integer()->notNull()->comment('номер гуруппы'),
            'students_id' => $this->integer()->notNull()->comment('номер студента'),
            'date_begin' => $this->date()->notNull()->comment('дата начала'),
            'date_окончания' => $this->date()->notNull()->comment('дата окончания'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('gs', 'добавлене истории по группам');
        $this->addForeignKey(
            'FK_c_gs_id',
            'groups',
            'created_by',
            'user',
            'id'
        );

        $this->addForeignKey(
            'FK_u_gs_id',
            'groups',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_gs_id',
            'groups',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('gs');
    }
}


