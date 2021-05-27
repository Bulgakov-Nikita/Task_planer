<?php

use \yii\db\Migration;

class m240521_205500_create_sprav_kafedra_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sprav_kafedra', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->text()->notNull()->comment('Название института'),
            'sprav_facultet_id' => $this->integer()->notNull()->comment('внешний ключ'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_kafedra', 'Таблица для хранения информации о кафедре');

        //FK
        $this->addForeignKey(
            'FK_sprav_facultet_id',
            'sprav_kafedra',
            'sprav_facultet_id',
            'sprav_facultet',
            'id'
        );
        $this->addForeignKey(
            'FK_c_sprav_kafedra_id',
            'sprav_kafedra',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_sprav_kafedra_id',
            'sprav_kafedra',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_sprav_kafedra_id',
            'sprav_kafedra',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('kafedra');

        //FK
        $this->dropForeigenKey('FK_facultet_id');
    }
}
