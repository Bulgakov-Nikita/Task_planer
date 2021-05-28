<?php

use \yii\db\Migration;

class m240521_220570_create_prepod_has_sprav_step_prepod_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prepod_has_sprav_step_prepod', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'prepod_id' => $this->integer()->notNull()->comment('ссылка на преподавателя'),
            'sprav_step_prepod_id'=> $this->integer()->notNull()->comment('ссылка на учёную степень'),
            'sprav_uch_god_id'=> $this->integer()->notNull()->comment('ссылка на учебный год'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prepod_has_sprav_step_prepod',
            'Таблица для хранения информации о учёной степени конкретного преподавателя');

        //FK
        $this->addForeignKey(
            'FK_prepodId_prepod_has_sprav_step_prepod',
            'prepod_has_sprav_step_prepod',
            'prepod_id',
            'prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_spravStepPrepodId_prepod_has_sprav_step_prepod',
            'prepod_has_sprav_step_prepod',
            'sprav_step_prepod_id',
            'sprav_step_prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_spravUchGodId_prepod_has_sprav_step_prepod',
            'prepod_has_sprav_step_prepod',
            'sprav_uch_god_id',
            'sprav_uch_god',
            'id'
        );
        // $this->addForeignKey(
        //     'FK_c_dc_id',
        //     'dc',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_dc_id',
        //     'dc',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_dc_id',
        //     'dc',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown()
    {
        $this->dropTable('prepod_has_sprav_step_prepod');

        //FK
        $this->dropForeigenKey('FK_prepodId_prepod_has_sprav_step_prepod', 'prepod');
        $this->dropForeigenKey('FK_spravStepPrepodId_prepod_has_sprav_step_prepod', 'sprav_step_prepod');
        $this->dropForeigenKey('FK_spravUchGodId_prepod_has_sprav_step_prepod', 'sprav_uch_god');
    }
}
