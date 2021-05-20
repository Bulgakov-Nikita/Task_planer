<?php

use yii\db\Schema;
use yii\db\Migration;

class m190521_142500_create_level_obucheniya_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('level_obucheniya', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'configuration' => $this->char(45)->notNull()->comment('Конфигурация')
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('level_obucheniya');
    }
}
