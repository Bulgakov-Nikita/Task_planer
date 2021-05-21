<?php

use \yii\db\Migration;

class m200521_212400_create_type_task_pd_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_task_pd', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->integer(11)->notNull()->comment('Тип задачи проф деятельности'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_task_pd', 'Таблица для хранения информации о Типе задач проф деятельности');
    }

    public function safeDown()
    {
        $this->dropTable('type_task_pd');
    }
}
