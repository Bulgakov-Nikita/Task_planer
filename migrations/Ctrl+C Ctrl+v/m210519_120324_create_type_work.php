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
            'semestr' => $this->integer()->comment('Номер семестра'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('type_work', 'Виды работ');
    }

    public function safeDown()
    {
        $this->dropTable('type_work');
    }
}
