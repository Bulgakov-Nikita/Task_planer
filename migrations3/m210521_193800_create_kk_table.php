<?php

use \yii\db\Migration;

class m210521_193800_create_kk_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('kk', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'comp_id' => $this->integer(11)->notNull()->comment('ссылка на компетенцию'),
            'kafedra_id' => $this->integer(11)->notNull()->comment('ссылка на кафедру'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('kk', 'Таблица для хранения информации о ссылках на кафедру и компетенцию');

        $this->addForeignKey(
            'FK_comp_id',
            'kk',
            'comp_id',
            'comp',
            'id');
        $this->addForeignKey(
            'FK_kafedra_id',
            'kk',
            'kafedra_id',
            'kafedra',
            'id');
    }

    public function safeDown()
    {
        $this->dropTable('kk');
        $this->dropForeignKey('FK_comp_id');
        $this->dropForeignKey('FK_kafedra_id');
    }
}