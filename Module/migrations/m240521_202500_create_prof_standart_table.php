<?php

use \yii\db\Migration;

class m240521_202500_create_prof_standart_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prof_standart', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'date' => $this->date()->notNull()->comment('дата проф стандарта'),
            'number' => $this->string(45)->notNull()->comment('номер проф стандарта'),
            
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prof_standart', 'Таблица для хранения информации о кафедре');
        $this->addForeignKey(
            'FK_c_prof_standart_id',
            'prof_standart',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_prof_standart_id',
            'prof_standart',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_prof_standart_id',
            'prof_standart',
            'deleted_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('prof_standart');
    }
}
