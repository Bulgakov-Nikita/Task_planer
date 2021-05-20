<?php

use \yii\db\Migration;

class m190521_215400_create_fgos_table extends Migration{
    public function safeUp(){
        $this->createTable('fgos',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number' => $this->char(45)->notNull()->comment('номер ФГОС'),
            'date' => $this->date()->notNull()->comment('дата ФГОС'),
            'path_file' => $this->text()->notNull()->comment('ссылка на файл')
        ]);
        $this->addCommentOnTable('fgos', 'Таблица которая ...');
    }

    public function safeDown(){
        $this->dropTable('fgos');
    }
}
