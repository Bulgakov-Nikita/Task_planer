<?php

use \yii\db\Migration;

class m240521_231000_create_room_has_type_room_table extends Migration{
    public function safeUp(){
        $this->createTable('room_has_type_room', [
            'room_id' => $this->integer()->notNull()->comment('id комнаты'),
            'type_room_id' => $this->integer()->notNull()->comment('id тип комнаты'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('room_has_type_room', 'Таблица, которая хранит тип комнаты для соответствующей комнаты');

        //FK
        $this->addForeignKey(
            'FK_type_room_id',
            'room_has_type_room',
            'room_id',
            'room',
            'id'
        );
        $this->addForeignKey(
            'FK_type_room_id333',
            'room_has_type_room',
            'type_room_id',
            'type_room',
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
            'PK_roomId-disciplinsId_room_has_disciplins333',
            'room_has_type_room',
            [
                'room_id',
                'type_room_id'
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('room_has_type_room');

        //FK
    }
}
