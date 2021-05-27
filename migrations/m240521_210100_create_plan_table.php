<?php

use \yii\db\Migration;

class m240521_210100_create_plan_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('plan', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'main_plan_id' => $this->integer()->notNull()->comment('ссылка на компетенцию 2'),
            'sprav_kafedra_id' => $this->integer()->comment('ссылка на кафедру'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('plan', 'Таблица для хранения информации о Плане');

        //FK
        $this->addForeignKey(
            'FK_kafedra_id333',
            'plan',
            'sprav_kafedra_id',
            'sprav_kafedra',
            'id'
        );
        $this->addForeignKey(
            'FK_mainPlanId_plan',
            'plan',
            'main_plan_id',
            'main_plan',
            'id'
        );
//        $this->addForeignKey(
//            'FK_c_plan_id',
//            'plan',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_plan_id',
//            'plan',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_plan_id',
//            'plan',
//            'delete_by',
//            'user',
//            'id'
//        );

    }

    public function safeDown()
    {
        $this->dropTable('plan');

        //FK
        $this->dropForeignKey('FK_mainPlanId_plan', 'main_plan');
        $this->dropForeignKey('FK_kafedra_id333', 'sprav_kafedra');
    }
}
