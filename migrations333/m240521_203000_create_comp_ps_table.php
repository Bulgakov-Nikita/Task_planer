<?php

use \yii\db\Migration;

class m240521_203000_create_comp_ps_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comp_ps', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'index' => $this->string(45)->notNull()->comment('индекс'),
            'name' => $this->text()->notNull()->comment('название компетенции 3'),
            'trebovanie' => $this->text()->comment('требования'),
            'parent_id' => $this->integer()->comment('ссылка самого на себя'),
            'prof_standart_id' => $this->integer()->notNull()->comment('номер и дата проф стандарта'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('comp_ps', 'Таблица для хранения информации о компетенции 3');

        //FK:
        $this->addForeignKey(
            'FK_parent_id123',
            'comp_ps',
            'parent_id',
            'comp_ps',
            'id'
        );
        $this->addForeignKey(
            'FK_1111111111',
            'comp_ps',
            'prof_standart_id',
            'prof_standart',
            'id'
        );
//        $this->addForeignKey(
//            'FK_c_comp_ps_id',
//            'comp_ps',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_comp_ps_id',
//            'comp_ps',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_comp_ps_id',
//            'comp_ps',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown()
    {
        $this->dropTable('comp_ps');
        
        //ВК
        $this->dropForeignKey('FK_parent_id123', 'comp_ps');
        $this->dropForeignKey('FK_1111111111', 'prof_standart');
    }
}