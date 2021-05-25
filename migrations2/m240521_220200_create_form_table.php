<?php

use \yii\db\Migration;

class m240521_220200_create_form_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('form', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'data' => $this->string(45)->comment('данные'),
            'type_form_id' => $this->integer()->notNull()->comment('ссылка на тип формы'),
            'disciplins_id' => $this->integer()->notNull()->comment('ссылка на дисциплину'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('form', 'Таблица для хранения информации о форме');

        //FK
        $this->addForeignKey(
            'FK_disciplins_id321',
            'form',
            'disciplins_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_type_form_id321',
            'form',
            'type_form_id',
            'type_form',
            'id'
        );
        $this->addForeignKey(
            'FK_c_form_id',
            'form',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_form_id',
            'form',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_form_id',
            'form',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('form');

        //FK
        $this->dropForeignKey('FK_type_form_id321', 'type_form');
        $this->dropForeignKey('FK_disciplins_id321', 'disciplins');
        $this->dropForeignKey('FK_c_form_id', 'user');
        $this->dropForeignKey('FK_u_form_id', 'user');
        $this->dropForeignKey('FK_d_form_id', 'user');
    }
}
