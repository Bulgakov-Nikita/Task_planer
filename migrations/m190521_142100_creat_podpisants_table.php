<?php

use yii\db\Migration;

class m190521_142200_creat_podpisants_table extends Migration{
    public function safeUp(){
        $this->createTable('podpisants', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'dolzhnost' => $this->char(150)->notNull()->comment('Должность подписанта'),
            'FIO' => $this->string()->notNull()->comment('фамилия имя отчество'),
            'utverzhdauchiy_id' => $this->integer(11)->notNull()->comment('id утверждающего'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('podpisants', 'для хранения ответственных за подписи');
        $this->addForeignKey(
            'FK_utverzhdauchiy_id',  // это "условное имя" ключа
            'requsites', // это название текущей таблицы
            'utverzhdauchiy_id', // это имя поля в текущей таблице, которое будет ключом
            'utverzhdauchiy', // это имя таблицы, с которой хотим связаться
            'id' // это поле таблицы, с которым хотим связаться
        );
        $this->addCommentOnTable('podpisants', 'привязка к таблице utverzhdauchiy для получения реквизитов утверждающего');
    }
    public function safeDown()
    {
        $this->dropTable('podpisants');

        $this->dropForeignKey(
            'utverzhdauchiy_id',
            'utverzhdauchiy'
        );

    }

}
