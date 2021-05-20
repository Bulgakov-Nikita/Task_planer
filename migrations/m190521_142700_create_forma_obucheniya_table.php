<?php

use \yii\db\Migration;

class m190521_142700_create_forma_obucheniya_table extends Migration{
    public function safeUp(){
        $this->createTable('forma_obucheniya',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(45)->notNull()->comment('Название формы обучения')
        ]);
        $this->addCommentOnTable('forma_obucheniya', 'Таблица для хранения форм обучения');
    }

    public function safeDown(){
        $this->dropTable('forma_obucheniya');
    }
}
