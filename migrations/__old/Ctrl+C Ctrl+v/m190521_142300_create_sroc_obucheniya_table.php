<?php

use yii\db\Schema;
use yii\db\Migration;

class m190521_142300_create_sroc_obucheniya_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sroc_obucheniya', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'sroc' => $this->char(45)->notNull()->comment('Срок'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('sroc_obucheniya');
    }
}