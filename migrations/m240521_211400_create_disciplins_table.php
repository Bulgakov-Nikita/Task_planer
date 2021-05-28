<?php

use \yii\db\Migration;

class m240521_211400_create_disciplins_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('disciplins', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'index' => $this->string(45)->notNull()->comment('индекс'),
            'parent_id' => $this->integer()->comment('ссылка самого на себя'),
            'sprav_dis_id' => $this->integer()->notNull()->comment('ссылка на компетенцию'),
            'plan_id' => $this->integer()->notNull()->comment('comment in light future'),
            'sprav_kafedra_id' => $this->integer()->notNull()->comment('comment in light future'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('disciplins', 'Таблица для хранения информации о компетенции 2');

        //FK
        $this->addForeignKey(
            'FK_parent_id111',
            'disciplins',
            'parent_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_comp_id333222111',
            'disciplins',
            'sprav_dis_id',
            'sprav_dis',
            'id'
        );
        $this->addForeignKey(
            'FK_comp_id123123',
            'disciplins',
            'plan_id',
            'plan',
            'id'
        );
        $this->addForeignKey(
            'FK_comp_id321321',
            'disciplins',
            'sprav_kafedra_id',
            'sprav_kafedra',
            'id'
        );
        $this->addForeignKey(
            'FK_c_disciplins_id',
            'disciplins',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_disciplins_id',
            'disciplins',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_disciplins_id',
            'disciplins',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('disciplins');

        //FK
        $this->dropForeignKey('FK_parent_id111', 'disciplins');
        $this->dropForeignKey('FK_comp_id333222111', 'sprav_dis');
        $this->dropForeignKey('FK_comp_id123123', 'plan');
        $this->dropForeignKey('FK_comp_id321321', 'sprav_kafedra');
    }
}