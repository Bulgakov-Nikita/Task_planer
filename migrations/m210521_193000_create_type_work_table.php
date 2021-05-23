<?php

use \yii\db\Migration;

class m210521_193000_create_type_work_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_work', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char()->notNull()->comment('Тип работы'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_work', 'Таблица для хранения информации о Типах работы');

    }

    public function safeDown()
    {
        $this->dropTable('type_work');
    }
}
