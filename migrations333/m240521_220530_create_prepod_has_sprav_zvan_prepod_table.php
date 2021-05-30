<?php

use \yii\db\Migration;

class m240521_220530_create_prepod_has_sprav_zvan_prepod_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prepod_has_sprav_zvan_prepod', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'sprav_zvan_prepod_id' => $this->integer()->notNull()->comment('ссылка на учёные звания'),
            'prepod_id' => $this->integer()->notNull()->comment('ссылка на преподавателя'),
            'sprav_uch_god_id'=> $this->integer()->notNull()->comment('ссылка на учебный год'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prepod_has_sprav_zvan_prepod',
            'Таблица для хранения информации о учёных званиях конкретного преподавателя');

        //FK
        $this->addForeignKey(
            'FK_prepodId_prepod_has_sprav_zvan_prepod',
            'prepod_has_sprav_zvan_prepod',
            'prepod_id',
            'prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_spravZvanPrepodId_prepod_has_sprav_zvan_prepod',
            'prepod_has_sprav_zvan_prepod',
            'sprav_zvan_prepod_id',
            'sprav_zvan_prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_spravUchGodId_prepod_has_sprav_zvan_prepod',
            'prepod_has_sprav_zvan_prepod',
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
        $this->dropTable('prepod_has_sprav_zvan_prepod');

        //FK
        $this->dropForeigenKey('FK_prepodId_prepod_has_sprav_zvan_prepod', 'prepod');
        $this->dropForeigenKey('FK_spravZvanPrepodId_prepod_has_sprav_zvan_prepod', 'sprav_zvan_prepod');
        $this->dropForeigenKey('FK_spravUchGodId_prepod_has_sprav_zvan_prepod', 'sprav_uch_god');
    }
}
