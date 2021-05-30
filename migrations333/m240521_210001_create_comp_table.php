<?php

use \yii\db\Migration;

class m240521_210001_create_comp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comp', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'index' => $this->string(45)->notNull()->comment('индекс'),
            'soderzhanie' => $this->text()->notNull()->comment('содержание'),
            'main_plan_id' => $this->integer()->notNull()->comment('id для учебного плана'),
            
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('comp', 'Таблица для хранения информации о компетенции');

        //FK:
//        $this->addForeignKey(
//            'FK_c_comp_id',
//            'comp',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_comp_id',
//            'comp',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_comp_id',
//            'comp',
//            'delete_by',
//            'user',
//            'id'
//        );
        $this->addForeignKey(
            'FK_main_plan_id_comp_id',
            'comp',
            'main_plan_id',
            'main_plan',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('comp');
        // сделать удаление внешних ключей
        $this->dropForeignKey('FK_main_plan_id_comp_id','main_plan');
    }
}
