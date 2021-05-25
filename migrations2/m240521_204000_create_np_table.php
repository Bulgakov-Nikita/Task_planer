<?php

use \yii\db\Migration;

class m240521_204000_create_np_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('np', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'code' => $this->string(45)->notNull()->comment('Код'),
            'name' => $this->string(45)->notNull()->comment('Название направления подготовки'),
            'comp_ps_id' => $this->integer()->comment('ссылка на проф стандарт'),
            'type_task_pd_id' => $this->integer()->notNull()->comment('ссылка на Тип задачи проф деятельности'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('np', 'Таблица для хранения информации о направления подготовки');

        //FK
        $this->addForeignKey(
            'FK_prof_standart_id33333',
            'np',
            'comp_ps_id',
            'comp_ps',
            'id'
        );
        $this->addForeignKey(
            'FK_type_task_pd_id33333',
            'np',
            'type_task_pd_id',
            'type_task_pd',
            'id'
        );
        $this->addForeignKey(
            'FK_c_np_id',
            'np',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_np_id',
            'np',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_np_id',
            'np',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('np');

        //FK
        $this->dropForeigenKey('FK_prof_standart_id33333', 'comp_ps');
        $this->dropForeigenKey('FK_type_task_pd_id33333', 'type_task_pd');
        $this->dropForeignKey('FK_c_np_id', 'user');
        $this->dropForeignKey('FK_u_np_id', 'user');
        $this->dropForeignKey('FK_d_np_id', 'user');
    }
}
