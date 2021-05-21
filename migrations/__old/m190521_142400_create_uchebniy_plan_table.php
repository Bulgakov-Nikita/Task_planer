<?php

use yii\db\Schema;
use yii\db\Migration;

class m190521_142400_create_uchebniy_plan_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('uchebniy_plan', [
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'god_postipleniya' => $this->integer()->notNull()->comment('Год поступления'),
            'god_obucheniya' => $this->integer()->notNull()->comment('Год обучения'),
            'protocol' => $this->char(45)->notNull()->comment('Утверждение учебного плана'),
            'data_protocol' => $this->date()->notNull()->comment('Дата утверждения учебного плана'),
            'sroc_obucheniya_id' => $this->integer()->notNull()->comment('id срока обучения')
        ]);

        // Добавление FOREIGN KEY
        $this->addForeignKey(
            'sroc_obucheniya_id',
            'uchebniy_plan',
            'sroc_obucheniya_id',
            'sroc_obucheniya',
            'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('uchebniy_plan');
    }
}