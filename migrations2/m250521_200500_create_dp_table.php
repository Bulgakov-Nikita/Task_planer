<?php

use \yii\db\Migration;

class m250521_200500_create_dp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('dp', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'prepod_id' => $this->integer()->notNull()->comment('ссылка на тип формы'),
            'disciplins_id' => $this->integer()->notNull()->comment(''),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('dp', 'Таблица для хранения информации о формах');
        $this->addForeignKey(
            'FK_prepod_id_dp',
            'dp',
            'prepod_id',
            'prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_disciplins_id_dp',
            'dp',
            'disciplins_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_c_dp_id',
            'dp',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_dp_id',
            'dp',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_dp_id',
            'dp',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('dp');
        $this->dropForeignKey('FK_prepod_id_dp', 'prepod');
        $this->dropForeignKey('FK_disciplins_id_dp', 'disciplins');
        $this->dropForeignKey('FK_c_dp_id', 'user');
        $this->dropForeignKey('FK_u_dp_id', 'user');
        $this->dropForeignKey('FK_d_dp_id', 'user');
    }
}