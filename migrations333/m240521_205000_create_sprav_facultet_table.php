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
            'FK_inctitut_id1111',
            'sprav_facultet',
            'institut_id',
            'institut',
            'id'
        );
//        $this->addForeignKey(
//            'FK_c_facultet_id',
//            'facultet',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_facultet_id',
//            'facultet',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_facultet_id',
//            'facultet',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown()
    {
        $this->dropTable('sprav_facultet');

        //FK
        $this->dropForeigenKey('FK_inctitut_id', 'institut');
    }
}
