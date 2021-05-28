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

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('gs', 'добавлене истории по группам');
        $this->addForeignKey(
            'FK_c_gs_id',
            'groups',
            'create_by',
            'user',
            'id'
        );

        $this->addForeignKey(
            'FK_u_gs_id',
            'groups',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_gs_id',
            'groups',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('gs');
    }
}


