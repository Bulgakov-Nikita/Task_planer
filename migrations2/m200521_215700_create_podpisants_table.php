<?php

use \yii\db\Migration;

class m200521_215700_create_podpisants_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('podpisants', [
            'id' => $this->primaryKey()->notNull()->comment('PK'),
            'staff_id' => $this->integer(11)->notNull()->comment('ссылка на сотрудников'),
            'main_plan_id' => $this->integer(11)->notNull()->comment('ссылка на главную таблицу'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('podpisants', 'Таблица для хранения информации о подписантов');
        $this->addForeignKey(
            'FK_staff_id',
            'podpisants',
            'staff_id',
            'staff',
            'id'
        );
        $this->addForeignKey(
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
