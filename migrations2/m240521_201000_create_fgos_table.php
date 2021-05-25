<?php

use \yii\db\Migration;

class m240521_201000_create_fgos_table extends Migration{
    public function safeUp(){
        $this->createTable('fgos',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number' => $this->string(45)->notNull()->unique()->comment('номер ФГОС'),
            'date' => $this->date()->notNull()->comment('дата ФГОС'),
            'path_file' => $this->text()->comment('ссылка на файл'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('fgos', 'Таблица которая ФГОС"ы');
        $this->addForeignKey(
            'FK_c_fgos_id',
            'fgos',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_fgos_id',
            'fgos',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_fgos_id',
            'fgos',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('fgos');
        $this->dropForeignKey('FK_c_fgos_id', 'user');
        $this->dropForeignKey('FK_u_fgos_id', 'user');
        $this->dropForeignKey('FK_d_fgos_id', 'user');
    }
}
