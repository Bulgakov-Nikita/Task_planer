<?php

use \yii\db\Migration;

class m240521_211500_create_kaf_has_comp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('kk', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer()->notNull()->comment('ссылка на компетенцию'),
            'kafedra_id' => $this->integer()->notNull()->comment('ссылка на кафедру'),
            
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('kk', 'Таблица для хранения информации о ссылках на кафедру и компетенцию');

        //FK
        $this->addForeignKey(
            'FK_comp_id111333',
            'kk',
            'comp_id',
            'comp',
            'id');
        $this->addForeignKey(
            'FK_kafedra_id111333',
            'kk',
            'kafedra_id',
            'kafedra',
            'id'
        );
        $this->addForeignKey(
            'FK_c_kk_id',
            'kk',
            'create_at',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_kk_id',
            'kk',
            'update_at',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_kk_id',
            'kk',
            'delete_at',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('kk');
        
        //FK
        $this->dropForeignKey('FK_comp_id111333', 'comp');
        $this->dropForeignKey('FK_kafedra_id111333', 'kafedra');
    }
}