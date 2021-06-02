<?php

use \yii\db\Migration;

class m240521_210200_create_nid_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('nid', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'code' => $this->string(45)->notNull()->comment(''),
            'main_plan_id' => $this->integer()->notNull()->comment('ссылка на план'),
            'perechen' => $this->text()->notNull()->comment('ссылка на кафедру'),
            'result' => $this->text()->notNull()->comment('ссылка на кафедру'),
            'svedenia' => $this->text()->notNull()->comment('ссылка на кафедру'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable(
            'nid',
            'Таблица для хранения информации о научно иследовательской деятельности');

        //FK
        $this->addForeignKey(
            'FK_main_paln_id3445',
            'nid',
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
        $this->dropTable('nid');

        //FK
        $this->dropForeignKey('FK_main_paln_id3445', 'main_plan');
    }
}
