<?php

use \yii\db\Migration;

class m200521_215400_create_fgos_table extends Migration{
    public function safeUp(){
        $this->createTable('fgos',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number' => $this->string(45)->notNull()->comment('номер ФГОС'),
            'date' => $this->date()->notNull()->comment('дата ФГОС'),
            'path_file' => $this->text()->notNull()->comment('ссылка на файл'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('fgos', 'Таблица которая ФГОС"ы');
    }

    public function safeDown(){
        $this->dropTable('fgos');
    }
}
