<?php

use \yii\db\Migration;

class m240521_210300_create_podpisants_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('podpisants', [
            'id' => $this->primaryKey()->notNull()->comment('PK'),
            'staff_id' => $this->integer()->notNull()->comment('ссылка на сотрудников'),
            'main_plan_id' => $this->integer()->notNull()->comment('ссылка на главную таблицу'),
            
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('podpisants', 'Таблица для хранения информации о подписантов');

        //FK
        $this->addForeignKey(
            'FK_staff_id444',
            'podpisants',
            'staff_id',
            'staff',
            'id'
        );
        $this->addForeignKey(
            'FK_main_plan_id444',
            'podpisants',
            'main_plan_id',
            'main_plan',
            'id'
        );
        $this->addForeignKey(
            'FK_c_podpisants_id',
            'podpisants',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_podpisants_id',
            'podpisants',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_podpisants_id',
            'podpisants',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('podpisants');

        //FK
        $this->dropForeigenKey('FK_staff_id444', 'staff');
        $this->dropForeigenKey('FK_main_plan_id444', 'main_plan');
    }
}
