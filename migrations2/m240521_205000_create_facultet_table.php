<?php

use \yii\db\Migration;

class m240521_205000_create_facultet_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('facultet', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->text()->notNull()->comment('Название института'),
            'institut_id' => $this->integer()->notNull()->comment('внешний ключ'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('facultet', 'Таблица для хранения информации о факультете');

        //FK
        $this->addForeignKey(
            'FK_inctitut_id1111',
            'facultet',
            'institut_id',
            'institut',
            'id'
        );
        $this->addForeignKey(
            'FK_c_facultet_id',
            'facultet',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_facultet_id',
            'facultet',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_facultet_id',
            'facultet',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('facultet');

        //FK
        $this->dropForeigenKey('FK_inctitut_id', 'institut');
        $this->dropForeignKey('FK_c_facultet_id', 'user');
        $this->dropForeignKey('FK_u_facultet_id', 'user');
        $this->dropForeignKey('FK_d_facultet_id', 'user');
    }
}
