<?php

use \yii\db\Migration;

class m190521_215500_create_main_plan_table extends Migration{
    public function safeUp(){
        $this->createTable('main_plan',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'date_sp' => $this->date()->notNull()->comment('год начала подготовки'),
            'date_education' => $this->date()->notNull()->comment('год обучения'),
            'date_ut' => $this->date()->notNull()->comment('дата утверждения'),
            'name_or' => $this->text()->notNull()->comment('название организации'),
            'name_ministry' => $this->text()->notNull()->comment('название министерства'),
            'n_protocol' => $this->char(45)->notNull()->comment('номер протокола'),
            'date_protocol' => $this->date()->notNull()->comment('дата протокола'),

            'fgos_id' => $this->integer()->notNull()->comment('id стандарта'),
            'kafedra_id' => $this->integer()->notNull()->comment('id реквизита'),
            'kvalification_id' => $this->integer()->notNull()->comment('id уровня обучения'),
            'np_id' => $this->integer()->notNull()->comment('id направления'),
            'fo_id' => $this->integer()->notNull()->comment('id формы обучения'),
            'staff_id' => $this->integet()->notNull()->comment(''),
            'sroc_obucheniya_id' => $this->integer()->notNull()->comment('id срока обучения')
        ]);
        $this->addCommentOnTable('main_plan', 'Таблица которая ...');

        //FOREIGN KEYS:
        $this->addForeignKey(
            'fgos_id', 'main_plan', 'fgos_id', 'fgos', 'id'
        );
        $this->addForeignKey(
            'kafedra_id', 'main_plan', 'kafedra_id', 'kafedra', 'id'
        );
        $this->addForeignKey(
            'kvalification_id', 'main_plan', 'kvalification_id', 'kvalification', 'id'
        );
        $this->addForeignKey(
            'np_id', 'main_plan', 'np_id', 'np', 'id'
        );
        $this->addForeignKey(
            'fo_id', 'main_plan', 'fo_id', 'fo', 'id'
        );
        $this->addForeignKey(
            'staff_id', 'main_plan', 'staff_id', 'staff', 'id'
        );
        $this->addForeignKey(
            'sroc_obucheniya_id1111', 'main_plan', 'sroc_obucheniya_id', 'sroc_obucheniya', 'id'
        );
    }

    public function safeDown(){
        $this->dropTable('main_plan');

        //DELETE FOREIGN KEYS
        $this->dropForeignKey('fgos_id', 'fgos');
        $this->dropForeignKey('kafedra_id', 'kafedra');
        $this->dropForeignKey('kvalification_id', 'kvalification');
        $this->dropForeignKey('np_id', 'np');
        $this->dropForeignKey('fo_id', 'fo');
        $this->dropForeignKey('staff_id', 'staff');
        $this->dropForeignKey('sroc_obucheniya_id1111', 'sroc_obucheniya');
    }
}
