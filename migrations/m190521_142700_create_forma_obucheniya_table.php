<?php

use \yii\db\Migration;

class m190521_142800_create_forma_obucheniya_table extends Migration{
    public function safeUp(){
        $this->createTable('forma_obucheniya',[
            'id' => $this->primaruKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(45)->noNull()->comment('Название формы обучения')
        ]);
        $this->addCommentOnTable('forma_obucheniya', 'Таблица для хранения форм обучения');
    }

    public function safeDown(){
        $this->dropTable('forma_obucheniya');
    }
}
