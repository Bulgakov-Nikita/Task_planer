<?php

use yii\db\Schema;
use yii\db\Migration;

class m190521_142300_create_sroc_obucheniya_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sroc_obucheniya', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'sroc' => $this->char(45)->notNull()->comment('Срок')
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('sroc_obucheniya');
    }
}