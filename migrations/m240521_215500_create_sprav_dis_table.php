<?php

use \yii\db\Migration;

class m240521_215500_create_sprav_dis_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sprav_dis', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(45)->notNull()->comment('тип дисциплины'),
            'kafedra_id' => $this->integer()->comment('Ссылка на кафедру'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('sprav_dis', 'Таблица для хранения информации о типе дисциплины');
        
        //FK
        $this->addForeignKey(
            'FK_kafedra_id_sprav_dis_id',
            'sprav_dis',
            'kafedra_id',
            'kafedra',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('sprav_dis');

        //FK
        $this->dropForeigenKey('FK_kafedra_id_sprav_dis_id', 'kafedra');
    }
}