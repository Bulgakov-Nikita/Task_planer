<?php

use yii\db\Migration;

class m190521_142200_create_requsites_table extends Migration{
    public function safeUp(){
        $this->createTable('requsites', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'organizaciya' => $this->string()->notNull()->comment('Название организации'),
            'chair' => $this->char(70)->notNull()->comment('Название кафедры'),
            'ministerstvo_obrazovaniya' => $this->char()->notNull()->comment('Министерство образования'),
            'soglasovano' => $this->char()->notNull()->comment('Поле согласованость'),
            'god_nachala_podgotovki' => $this->integer(11)->notNull()->comment('Год начала подготовки'),
            'podpisants_id' => $this->integer(11)->notNull()->comment('Подписанты документов'),

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

