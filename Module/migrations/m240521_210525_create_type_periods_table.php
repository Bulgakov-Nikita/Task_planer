<?php

use \yii\db\Migration;

class m240521_210525_create_type_periods_table extends Migration{
    public function safeUp(){
        $this->createTable('type_periods',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('(очная, заочная) названи формы обучения'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_periods', 'Таблица которая хранит тип периода');
        $this->addForeignKey(
            'FK_c_type_periods_id',
            'type_periods',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_type_periods_id',
            'type_periods',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_type_periods_id',
            'type_periods',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown(){
        $this->dropTable('type_periods');
    }
}
