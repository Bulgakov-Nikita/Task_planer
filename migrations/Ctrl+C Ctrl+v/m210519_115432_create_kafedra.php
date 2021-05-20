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
            'name' => $this->string()->comment('Название кафедры'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('kafedra', 'Здесь хранятся кафедры');
    }

    public function safeDown()
    {
        $this->dropTable('kafedra');
    }

}