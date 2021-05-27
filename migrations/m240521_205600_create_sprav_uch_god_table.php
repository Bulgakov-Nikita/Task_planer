<?php

use \yii\db\Migration;

class m240521_205600_create_sprav_uch_god_table extends Migration{
    public function safeUp(){
        $this->createTable('sprav_uch_god',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(100)->notNull()->comment('Название?'),
            'year_begin' => $this->integer(11)->comment('Год начала учебного года'),
            'year_end' => $this->integer(11)->comment('Год конца учебного года'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_uch_god', 'Хранит учебный год');

        //FOREIGN KEYS:
//        $this->addForeignKey(
//            'FK_c_main_plan_id333',
//            'sprav_uch_god',
//            'create_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_u_main_plan_id333',
//            'sprav_uch_god',
//            'update_by',
//            'user',
//            'id'
//        );
//        $this->addForeignKey(
//            'FK_d_main_plan_id333',
//            'sprav_uch_god',
//            'delete_by',
//            'user',
//            'id'
//        );
    }

    public function safeDown(){
        $this->dropTable('sprav_uch_god');

        //DELETE FOREIGN KEYS
    }
}
