<?php

use \yii\db\Migration;

class m240521_211500_create_kaf_has_comp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('kaf_has_comp', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer()->notNull()->comment('ссылка на компетенцию'),
            'sprav_kafedra_id' => $this->integer()->notNull()->comment('ссылка на кафедру'),
            
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('kaf_has_comp', 'Таблица для хранения информации о ссылках на кафедру и компетенцию');

        //FK
        $this->addForeignKey(
            'FK_kaf_has_comp_id111333',
            'kaf_has_comp',
            'comp_id',
            'comp',
            'id');
        $this->addForeignKey(
            'FK_kafedra_id111333',
            'kaf_has_comp',
            'sprav_kafedra_id',
            'sprav_kafedra',
            'id'
        );
        $this->addForeignKey(
            'FK_c_kaf_has_comp_id',
            'kaf_has_comp',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_kaf_has_comp_id',
            'kaf_has_comp',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_kaf_has_comp_id',
            'kaf_has_comp',
            'delete_by',
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