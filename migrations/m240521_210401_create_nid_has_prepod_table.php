<?php

use \yii\db\Migration;

class m240521_210401_create_nid_has_prepod_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('nid_has_prepod', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'nid_id' => $this->integer()->notNull()->comment(''),
            'prepod_id' => $this->integer()->notNull()->comment(''),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable(
            'nid_has_prepod',
            'Таблица для соответствия научной иследовательской деятельности к преподавателям ');

        //FK
        $this->addForeignKey(
            'FK_nidId_nidHasPrepod',
            'nid_has_prepod',
            'nid_id',
            'nid',
            'id'
        );
        $this->addForeignKey(
            'FK_prepodId_nidHasPrepod',
            'nid_has_prepod',
            'prepod_id',
            'prepod',
            'id'
        );


//        $this->addForeignKey(
//            'FK_c_period_id',
//            'period',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_period_id',
//            'period',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_period_id',
//            'period',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown()
    {
        $this->dropTable('nid_has_prepod');

        //FK
        $this->dropForeigenKey('FK_nidId_nidHasPrepod', 'nid');
        $this->dropForeigenKey('FK_prepodId_nidHasPrepod', 'prepod');
    }
}

