<?php

use \yii\db\Migration;

class m240521_203500_create_type_task_pd_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_task_pd', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('Тип задачи проф деятельности'),
            
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_task_pd', 'Таблица для хранения информации о Типе задач проф деятельности');
        $this->addForeignKey(
            'FK_c_type_task_pd_id',
            'type_task_pd',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_type_task_pd_id',
            'type_task_pd',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_type_task_pd_id',
            'type_task_pd',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('type_task_pd');
    }
}
