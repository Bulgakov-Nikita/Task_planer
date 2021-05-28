<?php

use \yii\db\Migration;

class m240521_210402_create_prep_rekv_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prep_rekv', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'prepod_id' => $this->integer()->notNull()->comment('препод ид'),
            'education' => $this->text()->comment('Уровень образования'),
            'kval_prepod' => $this->text()->comment('квалификация преподавателя'),
            'svedenia' => $this->text()->comment('Сведения о повышении квалификации и (или) профессиональной переподготовке'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prep_rekv', 'Таблица для хранения проффесиональной информации о преподавателе');

        //FK
        $this->addForeignKey('FK_prepodId_prepRekv',
            'prep_rekv',
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
        $this->dropTable('prep_rekv');

        //FK
        $this->dropForeigenKey('FK_prepodId_prepRekv', 'prepod');
    }
}


