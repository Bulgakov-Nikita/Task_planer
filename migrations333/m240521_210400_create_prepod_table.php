<?php

use \yii\db\Migration;

class m240521_210400_create_prepod_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prepod', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'staff_id' => $this->integer()->notNull()->comment('Дата начала периода'),
            'f' => $this->string(100)->notNull()->comment('Фамилия'),
            'i' => $this->string(100)->notNull()->comment('Имя'),
            'o' => $this->string(100)->notNull()->comment('Отчество'),
            'birthday' => $this->date()->comment('День рождения'),
            'email' => $this->string(100)->comment('Дата конца периода'),
            'phone' => $this->text()->comment('Номер телефона'),
            'user_id' => $this->integer()->comment('юзер ид'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prepod', 'Таблица для хранения информации об преподавателях');

        //FK
        $this->addForeignKey(
            'FK_c_period_id12',
            'prepod',
            'staff_id',
            'staff',
            'id'
        );
        $this->addForeignKey(
            'FK_userId_prepod',
            'prepod',
            'user_id',
            'user',
            'id'
        );
//        $this->addForeignKey(
//            'FK_c_period_id',
//            'prepod',
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
        $this->dropTable('prepod');

        //FK
        $this->dropForeigenKey('FK_c_period_id12', 'staff');
        $this->dropForeigenKey('FK_userId_prepod', 'user');
    }
}
