<?php

use \yii\db\Migration;

class m200521_212500_create_np_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('np', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'code' => $this->integer(11)->notNull()->comment('Код'),
            'name' => $this->integer(11)->notNull()->comment('Название направления подготовки'),
            'prof_standart_id' => $this->integer(11)->notNull()->comment('ссылка на проф стандарт'),
            'type_task_pd_id' => $this->integer(11)->notNull()->comment('ссылка на Тип задачи проф деятельности'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tyniinteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentTable('np', 'Таблица для хранения информации о направления подготовки');
        $this->addForeigenKey(
            'FK_prof_standart_id',
            'np',
            'prof_standart_id',
            'prof_standart',
            'id'
        );
        $this->addForeigenKey(
            'FK_type_task_pd_id',
            'np',
            'type_task_pd_id',
            'type_task_pd',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('np');
        $this->dropForeigenKey('FK_type_task_pd_id');
        $this->dropForeigenKey('FK_prof_standart_id');
    }
}
