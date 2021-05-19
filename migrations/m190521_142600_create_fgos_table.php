<?php

use \yii\db\Migration;

class m190521_142600_create_fgos_table extends Migration{
    public function safeUp(){
        $this->createTable('fgos',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(45)->noNull()->comment('Название образовательных стандарта')
        ]);
        $this->addCommentOnTable('fgos', 'Таблица для хранения образовательных стандартов');
    }

    public function safeDown(){
        $this->dropTable('fgos');
    }
}
