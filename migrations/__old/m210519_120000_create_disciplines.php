<?php

use yii\db\Migration;

/**
 * Class m210519_120000_create_disciplines
 */
class m210519_120000_create_disciplines extends Migration
{

    public function safeUp()
    {
        $this->createTable('disciplines', [
            'id' => $this->primaryKey()->notNull()->comment('ПК для таблицы дисциплины'),
            'name' => $this->char(200)->comment('Название дисциплины'),
            'number_disciplinescol' => $this->char(45)->comment('Код дисциплины')
        ]);
        $this->addCommentOnTable('disciplines', 'Виды дисциплин');
    }

    public function safeDown()
    {
        $this->dropTable('disciplines');
    }
}
