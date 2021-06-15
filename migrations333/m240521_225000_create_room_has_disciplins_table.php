<?php

use \yii\db\Migration;

class m240521_225000_create_room_has_disciplins_table extends Migration{
    public function safeUp(){
        $this->createTable('room_has_disciplins', [
            'room_id' => $this->integer()->notNull()->comment('id комнаты для которой относиться дисциплина'),
            'disciplins_id' => $this->integer()->notNull()->comment('id дисциплины, которая привязывается к этой комнате'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('room_has_disciplins', 'Таблица, которая хранит привязку дисциплины к комнате');

        //FK
        $this->addForeignKey(
            'FK_roomROOM',
            'room_has_disciplins',
            'room_id',
            'room',
            'id'
        );
        $this->addForeignKey(
            'FK_roomROOM333',
            'room_has_disciplins',
            'disciplins_id',
            'disciplins',
            'id'
        );
        // $this->addForeignKey(
        //     'FK_c_form_id',
        //     'form',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_form_id',
        //     'form',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_form_id',
        //     'form',
        //     'delete_by',
        //     'user',
        //     'id'
        // );

        //PK:
        $this->addPrimaryKey(
            'PK_roomId-disciplinsId_room_has_disciplins111',
            'room_has_disciplins',
            [
                'room_id',
                'disciplins_id'
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('room_has_disciplins');

        //FK
    }
}
