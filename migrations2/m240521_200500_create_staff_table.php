<?php

use \yii\db\Migration;

class m240521_200500_create_staff_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('staff', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'FIO' => $this->text()->notNull()->comment('Фамилия имя отчество'),
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
        $this->dropForeignKey('FK_c_staff_id', 'user');
        $this->dropForeignKey('FK_u_staff_id', 'user');
        $this->dropForeignKey('FK_d_staff_id', 'user');
    }
}
