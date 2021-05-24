<?php

use \yii\db\Migration;

class m240521_214500_create_type_form_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_form', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->unique()->notNull()->comment('тип формы'),
            
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_form', 'Таблица для хранения информации о типе формы');
    }

    public function safeDown()
    {
        $this->dropTable('type_form');
    }
}
