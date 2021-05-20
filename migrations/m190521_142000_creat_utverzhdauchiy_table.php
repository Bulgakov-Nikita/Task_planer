<?php

use yii\db\Migration;

class m190521_142200_creat_utverzhdauchiy_table extends Migration{
    public function safeUp(){
        $this->createTable('utverzhdauchiy', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(60)->notNull()->comment('Реквизиты/ФИО'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('utverzhdauchiy', 'для хранения реквизитов утверждающего');
    }
    public function safeDown()
    {
        $this->dropTable('utverzhdauchiy');

    }

}
