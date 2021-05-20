<?php

use \yii\db\Migration;

class m190521_215100_create_sroc_education_table extends Migration{
    public function safeUp(){
        $this->createTable('fo',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(30)->notNull()->comment('срок обучения')
        ]);
        $this->addCommentOnTable('fo', 'Таблица которая ...');
    }

    public function safeDown(){
        $this->dropTable('fo');
    }
}
