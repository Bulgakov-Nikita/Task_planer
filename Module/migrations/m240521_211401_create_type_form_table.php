<?php

use \yii\db\Migration;

class m240521_211401_create_type_form_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_form', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('тип формы'),
            
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_form', 'Таблица для хранения информации о типе формы');
        $this->addForeignKey(
            'FK_c_type_form_id',
            'type_form',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_type_form_id',
            'type_form',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_type_form_id',
            'type_form',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('type_form');
    }
}
