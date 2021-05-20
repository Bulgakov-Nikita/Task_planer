<?php

use \yii\db\Migration;

class m200521_212600_create_podpisants_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('podpisants', [
            'staff_id' => $this->integer(11)->notNull()->comment('ссылка на сотрудников'),
            'main_plan_id' => $this->integer(11)->notNull()->comment('ссылка на главную таблицу'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tyniinteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentTable('podpisants', 'Таблица для хранения информации о подписантов');
        $this->addForeigenKey(
            'FK_staff_id',
            'podpisants',
            'prof_staff_id',
            'staff',
            'id'
        );
        $this->addForeigenKey(
            'FK_main_plan_id',
            'podpisants',
            'main_plan_id',
            'main_plan',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('podpisants');
        $this->dropForeigenKey('FK_staff_id');
        $this->dropForeigenKey('FK_prof_standart_id');
    }
}
