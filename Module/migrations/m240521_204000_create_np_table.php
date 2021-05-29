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
            'type_task_pd_id' => $this->integer()->comment('ссылка на Тип задачи проф деятельности'),
            'comp_ps_id' => $this->integer()->comment('ссылка на проф стандарт'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
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
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_np_id',
            'np',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_np_id',
            'np',
            'deleted_by',
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
    }
}
