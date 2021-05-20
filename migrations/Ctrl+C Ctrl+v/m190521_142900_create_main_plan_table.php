<?php

use \yii\db\Migration;

class m190521_142900_create_main_plan_table extends Migration{
    public function safeUp(){
        $this->createTable('main_plan',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'fgos_id' => $this->integer()->notNull()->comment('id стандарта'),
            'requsites_id' => $this->integer()->notNull()->comment('id реквизита'),
            'sroc_obucheniya_id' => $this->integer()->notNull()->comment('id срока обучения'),
            'level_obucheniya_id' => $this->integer()->notNull()->comment('id уровня обучения'),
            'napravlenie_podgotovci_id' => $this->integer()->notNull()->comment('id направления'),
            'forma_obucheniya_id' => $this->integer()->notNull()->comment('id формы обучения'),
            'uchebniy_plan_id' => $this->integer()->notNull()->comment('id учебного плана'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('main_plan', 'Таблица которая хранит план, на основе других таблиц');

        //FOREIGN KEYS:
        $this->addForeignKey(
            'fgos_id', 'main_plan', 'fgos_id', 'fgos', 'id'
        );
        $this->addForeignKey(
            'requsites_id', 'main_plan', 'requsites_id', 'requsites', 'id'
        );
        $this->addForeignKey(
            'sroc_obucheniya_id1111', 'main_plan', 'sroc_obucheniya_id', 'sroc_obucheniya', 'id'
        );
        $this->addForeignKey(
            'level_obucheniya_id', 'main_plan', 'level_obucheniya_id', 'level_obucheniya', 'id'
        );
        $this->addForeignKey(
            'napravlenie_podgotovci_id', 'main_plan', 'napravlenie_podgotovci_id', 'napravlenie_podgotovci', 'id'
        );
        $this->addForeignKey(
            'forma_obucheniya_id', 'main_plan', 'forma_obucheniya_id', 'forma_obucheniya', 'id'
        );
        $this->addForeignKey(
            'uchebniy_plan_id', 'main_plan', 'uchebniy_plan_id', 'uchebniy_plan', 'id'
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