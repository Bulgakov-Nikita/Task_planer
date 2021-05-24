<?php

use \yii\db\Migration;

class m210521_194000_create_comp3_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comp3', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'index' => $this->string(45)->notNull()->comment('индекс'),
            'name' => $this->string(45)->notNull()->comment('название компетенции 3'),
            'trebovanie' => $this->text()->notNull()->comment('требования'),
            'comp_id' => $this->integer(11)->notNull()->comment('ссылка на компетенцию'),
            'parent_id' => $this->integer(11)->notNull()->comment('ссылка самого на себя'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('comp3', 'Таблица для хранения информации о компетенции 3');

        $this->addForeignKey(
            'FK_comp_id123',
            'comp3',
            'comp_id',
            'comp',
            'id');
        $this->addForeignKey(
            'FK_parent_id123',
            'comp3',
            'parent_id',
            'comp3',
            'id');
    }

    public function safeDown()
    {
        $this->dropTable('comp3');
        $this->dropForeignKey('FK_comp_id');
        $this->dropForeignKey('FK_parent_id');
    }
}