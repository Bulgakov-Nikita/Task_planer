<?php

use \yii\db\Migration;

class m240521_210600_create_staj_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('staj', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'prepod_id' => $this->integer()->notNull()->comment('препод ид'),
            'type_staj_id'=> $this->integer()->notNull()->comment('тип стажа'),
            'years'=>$this->integer()->comment('год'),
            'mounth' => $this->integer()->comment('месяц'),
            'days' => $this->integer()->comment('день'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('staj', 
        'Таблица отражает опыт работы преподавателя');

        //FK
        $this->addForeignKey(
            'FK_c_staj_id44542',
            'staj',
            'prepod_id',
            'prepod',
            'id'
        );

        $this->addForeignKey(
            'FK_c_staj_id44546',
            'staj',
            'type_staj_id',
            'type_staj',
            'id'
        );

        // $this->addForeignKey(
        //     'FK_c_period_id',
        //     'prep_rekv',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_period_id',
        //     'period',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_period_id',
        //     'period',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown()
    {
        $this->dropTable('period');

        //FK
        $this->dropForeigenKey('FK_c_staj_id44542', 'prepod');
        $this->dropForeigenKey('FK_c_staj_id44546', 'type_staj');
    }
}
