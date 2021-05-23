<?php

use \yii\db\Migration;

class m210521_193700_create_comp_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comp', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'index' => $this->string(45)->notNull()->comment('индекс'),
            'soderzhanie' => $this->text()->notNull()->comment('содержание'),
            'type_comp_id' => $this->integer(11)->notNull()->comment('ссылка на план'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('comp', 'Таблица для хранения информации о компетенции');

        $this->addForeignKey(
            'FK_type_comp_id',
            'comp',
            'type_comp_id',
            'type_comp',
            'id');
    }

    public function safeDown()
    {
        $this->dropTable('comp');
        $this->dropForeignKey('FK_type_comp_id');
    }
}
