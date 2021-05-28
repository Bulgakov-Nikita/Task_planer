<?php

use \yii\db\Migration;

class m240521_205000_create_sprav_facultet_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sprav_facultet', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->text()->notNull()->comment('Название института'),
            'institut_id' => $this->integer()->notNull()->comment('внешний ключ'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_facultet', 'Таблица для хранения информации о факультете');

        //FK
        $this->addForeignKey(
            'FK_sprav_facultet_id1111',
            'sprav_facultet',
            'institut_id',
            'institut',
            'id'
        );
        $this->addForeignKey(
            'FK_c_sprav_facultet_id',
            'sprav_facultet',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_sprav__facultet_id',
            'sprav_facultet',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_sprav__facultet_id',
            'sprav_facultet',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('facultet');

        //FK
        $this->dropForeigenKey('FK_inctitut_id', 'institut');
    }
}
