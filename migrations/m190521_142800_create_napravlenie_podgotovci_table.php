<?php

use \yii\db\Migration;

class m190521_142800_create_napravlenie_podgotovci_table extends Migration{
    public function safeUp(){
        $this->createTable('napravlenie_podgotovci',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(45)->noNull()->comment('Название направления подготовки')
        ]);
        $this->addCommentOnTable('napravlenie_podgotovci', 'Таблица для хранения направления подготовки');
    }

    public function safeDown(){
        $this->dropTable('napravlenie_podgotovci');
    }
}
