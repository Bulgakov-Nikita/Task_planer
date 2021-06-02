<?php

use \yii\db\Migration;

class m240521_224500_create_room_has_items_table extends Migration{
    public function safeUp(){
        $this->createTable('room_has_items', [
            'room_id' => $this->integer()->notNull()->comment('id комнаты для которой соотносится предмет, в которой он хранится'),
            'items_id' => $this->integer()->notNull()->comment('id предмета для, который хранится в комнате'),
            'discription' => $this->text()->comment('Описание к предмету, который распологается в этой комнате, ну по крайней мере так задумывалось'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('room_has_items', 'Таблица, которая хранит предметы для конкретных комнат');

        //FK
        $this->addForeignKey(
            'FK_1234567890',
            'room_has_items',
            'room_id',
            'room',
            'id'
        );
        $this->addForeignKey(
            'FK_0987654321',
            'room_has_items',
            'items_id',
            'items',
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
            'PK_roomId-disciplinsId_room_has_disciplins444',
            'room_has_items',
            [
                'room_id',
                'items_id'
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('room_has_items');

        //FK
    }
}
