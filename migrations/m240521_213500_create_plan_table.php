<?php

use \yii\db\Migration;

class m240521_213500_create_plan_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('plan', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'main_plan_id' => $this->integer()->notNull()->comment('ссылка на компетенцию 2'),
            'kurs_id' => $this->integer()->notNull()->comment('ссылка на курсы'),
            'kafedra_id' => $this->integer()->notNull()->comment('ссылка на кафедру'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('plan', 'Таблица для хранения информации о Плане');

        //FK
        $this->addForeignKey(
            'FK_comp2_id333',
            'plan',
            'main_plan_id',
            'main_plan',
            'id'
        );
        $this->addForeignKey(
            'FK_spravochnic2_id333',
            'plan',
            'kurs_id',
            'kurs',
            'id'
        );
        $this->addForeignKey(
            'FK_kafedra_id333',
            'plan',
            'kafedra_id',
            'kafedra',
            'id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('plan');

        //FK
        $this->dropForeignKey('FK_comp2_id333', 'main_plan');
        $this->dropForeignKey('FK_spravochnic2_id333', 'kurs');
        $this->dropForeignKey('FK_kafedra_id333', 'kafedra');
    }
}
