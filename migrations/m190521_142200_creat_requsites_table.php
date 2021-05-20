<?php

use yii\db\Migration;

class m190521_142200_creat_requsites_table extends Migration{
    public function safeUp(){
        $this->createTable('requsites', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'organizaciya' => $this->string()->notNull()->comment('Название организации'),
            'chair' => $this->char(70)->notNull()->comment('Название кафедры'),
            'ministerstvo_obrazovaniya' => $this->char()->notNull()->comment('Министерство образования'),
            'soglasovano' => $this->char()->notNull()->comment('Поле согласованость'),
            'god_nachala_podgotovki' => $this->integer(11)->notNull()->comment('Год начала подготовки'),
            'podpisants_id' => $this->integer(11)->notNull()->comment('Подписанты документов'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),

        ]);
        $this->addCommentOnTable('requsites', 'для хранения реквизитов');
        $this->addForeignKey(
            'FK_podpisants_id',  // это "условное имя" ключа
            'requsites', // это название текущей таблицы
            'podpisants_id', // это имя поля в текущей таблице, которое будет ключом
            'podpisants', // это имя таблицы, с которой хотим связаться
            'id' // это поле таблицы, с которым хотим связаться
        );
        $this->addCommentOnTable('requsites', 'привязка к таблице podpisants для точного определенияя реквизитов организации');
    }
    public function safeDown()
    {
        $this->dropTable('requsites');

        $this->dropForeignKey(
            'podpisants_id',
            'podpisants'
        );

    }

}

