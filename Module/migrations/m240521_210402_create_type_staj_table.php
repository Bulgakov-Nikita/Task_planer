<?php

use \yii\db\Migration;

class m240521_210402_create_type_staj_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_staj', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(100)->notNull()->comment(''),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_staj', 'Таблица для хранения информации о периоде');

        //FK
//        $this->addForeignKey(
//            'FK_c_period_id',
//            'period',
//            'created_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_period_id',
//            'period',
//            'updated_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_period_id',
//            'period',
//            'deleted_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown()
    {
        $this->dropTable('type_staj');

        //FK
    }
}



