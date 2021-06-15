<?php

use \yii\db\Migration;

class m240521_222710_create_ze_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('ze', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'value' => $this->float()->notNull()->comment('данные'),
            'type_ze_id' => $this->integer()->notNull()->comment('ссылка на тип з.е'),
            'disciplins_id' => $this->integer()->notNull()->comment('ссылка на'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('ze', 'Таблица для хранения информации о з.е');

        //FK
        $this->addForeignKey(
            'FK_disciplins_id_ze',
            'ze',
            'disciplins_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_typeZe_ze',
            'ze',
            'type_ze_id',
            'type_ze',
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
        $this->dropTable('form');

        //FK
        $this->dropForeignKey('FK_disciplins_id_ze', 'disciplins');
        $this->dropForeignKey('FK_typeZe_ze', 'type_ze');
    }
}
