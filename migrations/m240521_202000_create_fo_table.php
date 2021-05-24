<?php

use \yii\db\Migration;

class m240521_202000_create_fo_table extends Migration{
    public function safeUp(){
        $this->createTable('fo',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(10)->notNull()->unique()->comment('(очная, заочная) названи формы обучения'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('fo', 'Таблица которая хранит форму обучения');
    }

    public function safeDown(){
        $this->dropTable('fo');
    }
}
