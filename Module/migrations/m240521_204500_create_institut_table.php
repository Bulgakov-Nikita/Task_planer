<?php

use \yii\db\Migration;

class m240521_204500_create_institut_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('institut', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->text()->notNull()->comment('Название института'),
            'code_filiala' => $this->string(45)->notNull()->comment('Название института'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('institut', 'Таблица хранит в себе название институтов');
        $this->addForeignKey(
            'FK_c_institut_id',
            'institut',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_institut_id',
            'institut',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_institut_id',
            'institut',
            'deleted_by',
            'user',
            'id'
        );
    }


    public function safeDown()
    {
        $this->dropTable('institut');
    }
}
