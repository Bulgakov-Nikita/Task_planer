<?php

use \yii\db\Migration;

class m200521_212100_create_facultet_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('facultet', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->text()->notNull()->comment('Название института'),
            'institut_id' => $this->integer(11)->notNull()->comment('внешний ключ'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('facultet', 'Таблица для хранения информации о факультете');
        $this->addForeignKey(
            'FK_inctitut_id1111',
            'facultet',
            'institut_id',
            'institut',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('facultet');
        $this->dropForeigenKey('FK_inctitut_id');
    }
}
