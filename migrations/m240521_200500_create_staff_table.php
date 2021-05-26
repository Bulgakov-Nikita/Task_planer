<?php

use \yii\db\Migration;

class m240521_200500_create_staff_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('staff', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'F' => $this->string(100)->notNull()->comment('Фамилия имя отчество Ф'),
            'I' => $this->string(100)->notNull()->comment('Фамилия имя отчество И'),
            'O' => $this->sring(100)->notNull()->comment('Фамилия имя отчество О'),
            'o' => $this->text()->notNull()->comment('о?'),
            'user_id' => $this->integer()->comment('юзер id'),

            'post' => $this->text()->notNull()->comment('должность'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('staff', 'Таблица для хранения информации о сотрудниках');
        $this->addForeignKey(
            'FK_c_staff_id',
            'staff',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_staff_id',
            'staff',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_staff_id',
            'staff',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('staff');
    }
}
