<?php

use \yii\db\Migration;

class m190521_215200_create_kvalification_table extends Migration{
    public function safeUp(){
        $this->createTable('kvalification',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(20)->notNull()->comment('название квалификация (бакалавр, магистратура, апирантура)')
        ]);
        $this->addCommentOnTable('kvalification', 'Таблица которая ...');
    }

    public function safeDown(){
        $this->dropTable('kvalification');
    }
}
