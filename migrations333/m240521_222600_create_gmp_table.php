<?php

use \yii\db\Migration;

class m240521_222600_create_gmp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('gmp', [
            'id' => $this->primaryKey()->notNull()->comment('PK'),
            'groups_id' => $this->integer()->notNull()->comment('ссылка на группы'),
            'main_plan_id' => $this->integer()->notNull()->comment('ссылка на главную таблицу'),
            'date_zakrep'=> $this->date()->notNull()->comment('дата закрепления плана '),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('gmp', 'Таблица для хранения учебных планов для групп');

        //FK
        $this->addForeignKey(
            'FK_groupsId_gmp',
            'gmp',
            'groups_id',
            'groups',
            'id'
        );
        $this->addForeignKey(
            'mainPlanId_gmp',
            'gmp',
            'main_plan_id',
            'main_plan',
            'id'
        );
//        $this->addForeignKey(
//            'FK_c_podpisants_id',
//            'podpisants',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_podpisants_id',
//            'podpisants',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_podpisants_id',
//            'podpisants',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown()
    {
        $this->dropTable('gmp');

        //FK
        $this->dropForeigenKey('FK_groupsId_gmp', 'groups');
        $this->dropForeigenKey('mainPlanId_gmp', 'main_plan');
    }
}
