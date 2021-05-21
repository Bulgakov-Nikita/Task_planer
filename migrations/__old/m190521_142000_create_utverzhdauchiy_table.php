<?php

use yii\db\Migration;

class m190521_142000_create_utverzhdauchiy_table extends Migration{
    public function safeUp(){
        $this->createTable('utverzhdauchiy', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'name' => $this->char(60)->notNull()->comment('Реквизиты/ФИО'),
        ]);
        $this->addCommentOnTable('utverzhdauchiy', 'для хранения реквизитов утверждающего');
    }

    public function safeDown()
    {
        $this->dropTable('utverzhdauchiy');

    }

}
