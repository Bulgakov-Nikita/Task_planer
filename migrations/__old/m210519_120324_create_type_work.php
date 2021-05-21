<?php

use yii\db\Migration;

/**
 * Class m210519_120324_create_type_work
 */
class m210519_120324_create_type_work extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_work', [
            'id' => $this->primaryKey()->notNull()->comment('ПК для таблицы тип_работы'),
            'name' => $this->char(45)->comment('Название типа работы'),
            'semestr' => $this->integer()->comment('Номер семестра')
        ]);
        $this->addCommentOnTable('type_work', 'Виды работ');
    }

    public function safeDown()
    {
        $this->dropTable('type_work');
    }
}
