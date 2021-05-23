<?php

use \yii\db\Migration;

class m200521_212300_create_prof_standart_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prof_standart', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'code' => $this->integer(11)->notNull()->comment('Код'),
            'name' => $this->integer(11)->notNull()->comment('Название проф стандарта'),
            'date' => $this->date()->notNull()->comment('дата проф стандарта'),
            'number' => $this->string(45)->notNull()->comment('номер проф стандарта'),
            'parent_id' => $this->integer(11)->notNull()->comment('ссылка самого на себя'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('prof_standart', 'Таблица для хранения информации о кафедре');
        $this->addForeignKey(
            'FK_parent_id',
            'prof_standart',
            'parent_id',
            'prof_standart',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('prof_standart');
        $this->dropForeigenKey('FK_parent_id');
    }
}
