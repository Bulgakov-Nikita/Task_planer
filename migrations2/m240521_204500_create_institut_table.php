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

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('institut', 'Таблица хранит в себе название институтов');
        $this->addForeignKey(
            'FK_c_institut_id',
            'institut',
            'create_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_institut_id',
            'institut',
            'update_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_institut_id',
            'institut',
            'delete_by',
            'user',
            'id'
        );
    }


    public function safeDown()
    {
        $this->dropTable('institut');
    }
}
