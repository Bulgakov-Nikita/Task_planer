<?php

use \yii\db\Migration;

class m240521_212000_create_type_work_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('type_work', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->string(250)->notNull()->comment('Тип работы'),
            
            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('type_work', 'Таблица для хранения информации о Типах работы');
        $this->addForeignKey(
            'FK_c_type_work_id',
            'type_work',
            'created_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_u_type_work_id',
            'type_work',
            'updated_by',
            'user',
            'id'
        );
        $this->addForeignKey(
            'FK_d_type_work_id',
            'type_work',
            'deleted_by',
            'user',
            'id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('type_work');
    }
}
