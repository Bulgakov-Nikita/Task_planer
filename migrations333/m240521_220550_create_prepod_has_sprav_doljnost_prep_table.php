<?php

use \yii\db\Migration;

class m240521_220550_create_prepod_has_sprav_doljnost_prep_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prepod_has_sprav_doljnost_prep', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'prepod_id' => $this->integer()->notNull()->comment('ссылка на преподавателя'),
            'sprav_doljnost_prep_id'=> $this->integer()->notNull()->comment('ссылка на должность'),
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
        $this->addCommentOnTable('prepod_has_sprav_doljnost_prep',
            'Таблица для хранения информации о должности конкретного преподавателя');

        //FK
        $this->addForeignKey(
            'FK_prepodId_prepod_has_sprav_doljnost_prep',
            'prepod_has_sprav_doljnost_prep',
            'prepod_id',
            'prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_spravDoljnostPrepID_prepod_has_sprav_doljnost_prep',
            'prepod_has_sprav_doljnost_prep',
            'sprav_doljnost_prep_id',
            'sprav_doljnost_prep',
            'id'
        );
        $this->addForeignKey(
            'FK_spravUchGodId_prepod_has_sprav_doljnost_prep',
            'prepod_has_sprav_doljnost_prep',
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
        $this->dropTable('prepod_has_sprav_doljnost_prep');

        //FK
        $this->dropForeigenKey('FK_prepodId_prepod_has_sprav_doljnost_prep', 'prepod');
        $this->dropForeigenKey('FK_spravDoljnostPrepID_prepod_has_sprav_doljnost_prep', 'sprav_doljnost_prep');
        $this->dropForeigenKey('FK_spravUchGodId_prepod_has_sprav_doljnost_prep', 'sprav_uch_god');
    }
}
