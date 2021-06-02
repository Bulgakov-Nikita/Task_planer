<?php

use \yii\db\Migration;

class m240521_222700_create_type_ze_table extends Migration{
    public function safeUp(){
        $this->createTable('type_ze',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(100)->notNull()->comment('название з.е'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_ze', 'Таблица которая хранит атрибуты з.е');

        // FK:
        // $this->addForeignKey(
        //     'FK_c_type_periods_id',
        //     'type_periods',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_type_periods_id',
        //     'type_periods',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_type_periods_id',
        //     'type_periods',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown(){
        $this->dropTable('type_ze');
    }
}
