<?php

use \yii\db\Migration;

class m240521_211300_create_sprav_dis_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sprav_dis', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(256)->notNull()->comment('тип дисциплины'),
            'sprav_kafedra_id' => $this->integer()->comment('Ссылка на кафедру'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_dis', 'Таблица для хранения информации о типе дисциплины');
        
        //FK
        $this->addForeignKey(
            'FK_kafedra_id_sprav_dis_id',
            'sprav_dis',
            'sprav_kafedra_id',
            'sprav_kafedra',
            'id'
        );
        // $this->addForeignKey(
        //     'FK_c_sprav_dis_id',
        //     'sprav_dis',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_sprav_dis_id',
        //     'sprav_dis',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_sprav_dis_id',
        //     'sprav_dis',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown()
    {
        $this->dropTable('sprav_dis');

        //FK
        $this->dropForeigenKey('FK_kafedra_id_sprav_dis_id', 'sprav_kafedra');
    }
}
