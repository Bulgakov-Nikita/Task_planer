<?php

use \yii\db\Migration;

class m190521_142800_create_napravlenie_podgotovci_table extends Migration{
    public function safeUp(){
        $this->createTable('napravlenie_podgotovci',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(45)->notNull()->comment('Название направления подготовки'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('napravlenie_podgotovci', 'Таблица для хранения направления подготовки');
    }

    public function safeDown(){
        $this->dropTable('napravlenie_podgotovci');
    }
}
