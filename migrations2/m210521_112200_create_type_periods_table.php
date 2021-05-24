<?php

use \yii\db\Migration;

class m210521_112200_create_type_periods_table extends Migration{
    public function safeUp(){
        $this->createTable('type_periods',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('(очная, заочная) названи формы обучения'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_periods', 'Таблица которая хранит тип периода');
    }

    public function safeDown(){
        $this->dropTable('type_periods');
    }
}
