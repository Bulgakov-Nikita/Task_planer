<?php

use \yii\db\Migration;

class m240521_220510_create_dp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('dp', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'prepod_id' => $this->integer()->notNull()->comment('ссылка на преподавателя'),
            'disciplins_id' => $this->integer()->notNull()->comment('ссылка на компетенции 2'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('dp',
            'Таблица для хранения информации о диспциплинах,которые преподаёт преподаватель');

        //FK
        $this->addForeignKey(
            'FK_prepodId_dp',
            'dp',
            'prepod_id',
            'prepod',
            'id'
        );
        $this->addForeignKey(
            'FK_disciplinsId_dp',
            'dp',
            'disciplins_id',
            'disciplins',
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
        $this->dropTable('dp');

        //FK
        $this->dropForeigenKey('FK_prepodId_dp', 'prepod');
        $this->dropForeigenKey('FK_disciplinsId_dp', 'disciplins');
    }
}
