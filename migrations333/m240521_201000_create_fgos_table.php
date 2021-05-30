<?php

use \yii\db\Migration;

class m240521_201000_create_fgos_table extends Migration{
    public function safeUp(){
        $this->createTable('fgos',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'number' => $this->string(45)->notNull()->comment('номер ФГОС'),
            'date' => $this->date()->notNull()->comment('дата ФГОС'),
            'path_file' => $this->text()->comment('ссылка на файл'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('fgos', 'Таблица которая ФГОС"ы');

        //FK:
//        $this->addForeignKey(
//            'FK_c_fgos_id',
//            'fgos',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_fgos_id',
//            'fgos',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_fgos_id',
//            'fgos',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown(){
        $this->dropTable('fgos');
    }
}
