<?php

use \yii\db\Migration;

class m240521_223500_create_items_table extends Migration{
    public function safeUp(){
        $this->createTable('items', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'category_items_id' => $this->integer()->notNull()->comment('категория предмета'),
            //type_items_room - должен хранить только: Спец. мебель, оборудование, ПО.
            'type_items_room' => $this->string(100)->notNull()->comment('тип предмета(Спец. мебель, оборудование, ПО. Хранит должен только эти значения)'),
            'name' => $this->string(100)->notNull()->comment('данные'),
            'discription' => $this->text()->comment('Описание к предмету'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('items', 'Таблица для хранения предмета');

        //FK
        $this->addForeignKey(
            'FK_items_id_items',
            'items',
            'category_items_id',
            'category_items',
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
    }

    public function safeDown()
    {
        $this->dropTable('items');

        //FK
        $this->dropForeignKey('FK_items_id_items', 'category_items');
    }
}
