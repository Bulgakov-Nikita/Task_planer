<?php

use \yii\db\Migration;

class m200521_215200_create_kvalification_table extends Migration{
    public function safeUp(){
        $this->createTable('kvalification',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(20)->notNull()->comment('название квалификация (бакалавр, магистратура, апирантура)'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('kvalification', 'Таблица которая хранит квалификацию');
    }

    public function safeDown(){
        $this->dropTable('kvalification');
    }
}
