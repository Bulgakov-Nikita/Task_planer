<?php

use \yii\db\Migration;

class m190521_215300_create_fo_table extends Migration{
    public function safeUp(){
        $this->createTable('fo',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(10)->notNull()->comment('(очная, заочная) названи формы обучения')
        ]);
        $this->addCommentOnTable('fo', 'Таблица которая ...');
    }

    public function safeDown(){
        $this->dropTable('fo');
    }
}
