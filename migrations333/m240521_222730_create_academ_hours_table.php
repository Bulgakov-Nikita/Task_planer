<?php

use \yii\db\Migration;

class m240521_222730_create_academ_hours_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('academ_hours', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'value' => $this->float()->notNull()->comment('данные'),
            'type_work_id' => $this->integer()->notNull()->comment('ссылка на тип формы'),
            'disciplins_id' => $this->integer()->notNull()->comment('ссылка на'),

            'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'created_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'updated_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'deleted_at' => $this->integer(11)->comment('дата удаления'),
            'deleted_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('academ_hours', 'Таблица для хранения информации о з.е');

        //FK
        $this->addForeignKey(
            'FK_disciplins_id_akkred_hours',
            'academ_hours',
            'disciplins_id',
            'disciplins',
            'id'
        );
        $this->addForeignKey(
            'FK_typeWork_akkred_hours',
            'academ_hours',
            'type_work_id',
            'type_work',
            'id'
        );
        // $this->addForeignKey(
        //     'FK_c_form_id',
        //     'form',
        //     'create_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_u_form_id',
        //     'form',
        //     'update_by',
        //     'user',
        //     'id'
        // );
        // $this->addForeignKey(
        //     'FK_d_form_id',
        //     'form',
        //     'delete_by',
        //     'user',
        //     'id'
        // );
    }

    public function safeDown()
    {
        $this->dropTable('form');

        //FK
        $this->dropForeignKey('FK_disciplins_id_akkred_hours', 'disciplins');
        $this->dropForeignKey('FK_typeWork_akkred_hours', 'type_work');
    }
}
