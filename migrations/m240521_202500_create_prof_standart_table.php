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
            
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prof_standart', 'Таблица для хранения информации о кафедре');
        $this->addForeignKey(
            'FK_c_prof_standart_id',
            'prof_standart',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_prof_standart_id',
            'prof_standart',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_prof_standart_id',
            'prof_standart',
            'delete_by',
            'user',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('prof_standart');
    }
}
