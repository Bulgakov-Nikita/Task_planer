<?php

use \yii\db\Migration;

class m240521_220580_create_sprav_facultet_has_prepod_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sprav_facultet_has_prepod', [
            'prepod_id' => $this->integer()->notNull()->comment('ссылка на преподавателя'),
            'sprav_facultet_id'=> $this->integer()->notNull()->comment('ссылка на факультет'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_facultet_has_prepod',
            'Таблица для хранения информации информацию о пренадлежности преподавателя к факультету');

        //FK
        $this->addForeignKey(
            'FK_prepodId_sprav_facultet_has_prepod',
            'sprav_facultet_has_prepod',
            'prepod_id',
            'prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_spravFacultetId_sprav_facultet_has_prepod',
            'sprav_facultet_has_prepod',
            'sprav_facultet_id',
            'sprav_facultet',
            'id'
        );

        //PK:
        $this->addPrimaryKey(
            'PK_spravFacultetId-prepodId_sprav_facultet_has_prepod',
            'sprav_facultet_has_prepod',
            [
                'prepod_id',
                'sprav_facultet_id'
            ]
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
        $this->dropTable('sprav_facultet_has_prepod');

        //FK
        $this->dropForeigenKey('FK_prepodId_sprav_facultet_has_prepod', 'prepod');
        $this->dropForeigenKey('FK_spravFacultetId_sprav_facultet_has_prepod', 'sprav_facultet');
    }
}
