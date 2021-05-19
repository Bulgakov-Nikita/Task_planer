<?php

use yii\db\Migration;

/**
 * Class m210519_115432_create_kafedra
 */
class m210519_115432_create_kafedra extends Migration
{

    public function safeUp()
    {
        $this->createTable('kafedra', [
            'id' => $this->primaryKey()->notNull()->comment('ПК для таблицы кафедра'),
            'name' => $this->string()->comment('Название кафедры')
        ]);
        $this->addCommentOnTable('kafedra', 'Здесь хранятся кафедры');
    }

    public function safeDown()
    {
        $this->dropTable('kafedra');
    }

}
