<?php

use \yii\db\Migration;

class m240521_210600_create_staj_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('staj', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'period_id' => $this->integer()->notNull()->comment(''),
            'type_staj_id'=> $this->integer()->notNull()->comment(''),
            'years'=>$this->integer()->comment(''),
            'mounth' => $this->integer()->comment(''),
            'days' => $this->integer()->comment(''),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('staj', 'Таблица для хранения информации о периоде');

        //FK
        $this->addForeignKey(
            'FK_c_staj_id44542',
            'staj',
            'period_id',
            'period',
            'id'
        );

        $this->addForeignKey(
            'FK_c_staj_id44546',
            'staj',
            'type_staj_id',
            'type_staj',
            'id'
        );

        $this->addForeignKey(
            'FK_c_staj_id',
            'prep_rekv',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_staj_id',
            'period',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_staj_id',
            'period',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('staj');

        //FK
        $this->dropForeigenKey('FK_type_staj_id444111', 'type_staj');
    }
}
