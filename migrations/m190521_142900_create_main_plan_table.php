<?php

use \yii\db\Migration;

class m190521_142600_create_main_plan_table extends Migration{
    public function safeUp(){
        $this->createTable('main_plan',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'fgos_id' => $this->integer()->noNull()->comment('id стандарта'),
            'requsites_id' => $this->integer()->noNull()->comment('id реквизита'),
            'sroc_obucheniya_id' => $this->integer()->noNull()->comment('id срока обучения'),
            'level_obucheniya_id' => $this->integer()->noNull()->comment('id уровня обучения'),
            'napravlenie_podgotovci_id' => $this->integer()->noNull()->comment('id направления'),
            'forma_obucheniya_id' => $this->integer()->noNull()->comment('id формы обучения'),
            'uchebniy_plan_id' => $this->integer()->noNull()->comment('id учебного плана')
        ]);
        $this->addCommentOnTable('main_plan', 'Таблица которая хранит план, на основе других таблиц');

        //FOREIGN KEYS:
        $this->addForeignKey(
            'fgos_id', 'main_plan', 'fgos_id', 'fgos', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'requsites_id', 'main_plan', 'requsites_id', 'requsites', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'sroc_obucheniya_id', 'main_plan', 'sroc_obucheniya_id', 'sroc_obucheniya', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'level_obucheniya_id', 'main_plan', 'level_obucheniya_id', 'level_obucheniya', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'napravlenie_podgotovci_id', 'main_plan', 'napravlenie_podgotovci_id', 'napravlenie_podgotovci', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'forma_obucheniya_id', 'main_plan', 'forma_obucheniya_id', 'forma_obucheniya', 'id', 'CASCADE'
        );
        $this->addForeignKey(
            'uchebniy_plan_id', 'main_plan', 'uchebniy_plan_id', 'uchebniy_plan', 'id', 'CASCADE'
        );
    }

    public function safeDown(){
        $this->dropTable('main_plan');

        //DELETE FOREIGN KEYS
        $this->dropForeignKey('fgos_id', 'fgos');
        $this->dropForeignKey('requsites_id', 'requsites');
        $this->dropForeignKey('sroc_obucheniya_id', 'sroc_obucheniya');
        $this->dropForeignKey('level_obucheniya_id', 'level_obucheniya');
        $this->dropForeignKey('napravlenie_podgotovci_id', 'napravlenie_podgotovci');
        $this->dropForeignKey('forma_obucheniya_id', 'forma_obucheniya');
        $this->dropForeignKey('uchebniy_plan_id', 'uchebniy_plan');
    }
}
