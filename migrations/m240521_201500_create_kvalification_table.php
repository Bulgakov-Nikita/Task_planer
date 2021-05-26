<?php

use \yii\db\Migration;

class m240521_201500_create_kvalification_table extends Migration{
    public function safeUp(){
        $this->createTable('kvalification',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(20)->notNull()->comment('название квалификация (бакалавр, магистратура, апирантура)'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('kvalification', 'Таблица которая хранит квалификацию');
        $this->addForeignKey(
            'FK_c_kvalification_id',
            'kvalification',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_kvalification_id',
            'kvalification',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_kvalification_id',
            'kvalification',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('kvalification');
    }
}
