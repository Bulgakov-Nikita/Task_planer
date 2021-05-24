<?php

use \yii\db\Migration;

class m240521_210000_create_main_plan_table extends Migration{
    public function safeUp(){
        $this->createTable('main_plan',[
            'id' => $this->primaryKey()->notNull()->comment('Первичный ключ'),
            'date_sp' => $this->date()->notNull()->comment('год начала подготовки'),
            'date_education' => $this->string(20)->notNull()->comment('год обучения'),
            'date_ut' => $this->date()->comment('дата утверждения'),
            'name_or' => $this->text()->notNull()->comment('название организации'),
            'name_ministry' => $this->text()->notNull()->comment('название министерства'),
            'n_protocol' => $this->string(45)->notNull()->comment('номер протокола'),
            'date_protocol' => $this->date()->notNull()->comment('дата протокола'),
            'fgos_id' => $this->integer()->notNull()->comment('id стандарта'),
            'kafedra_id' => $this->integer()->notNull()->comment('id реквизита'),
            'kvalification_id' => $this->integer()->notNull()->comment('id уровня обучения'),
            'np_id' => $this->integer()->notNull()->comment('id направления'),
            'fo_id' => $this->integer()->notNull()->comment('id формы обучения'),
            'staff_id' => $this->integer()->notNull()->comment(''),
            'sroc_education_id' => $this->integer()->notNull()->comment('id срока обучения'),

            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата обновления'),
            'update_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'delete_at' => $this->integer(11)->comment('дата удаления'),
            'delete_by' => $this->integer(11)->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка')
        ]);
        $this->addCommentOnTable('main_plan', 'Таблица которая "объединяет" все таблицы, для состовления титульного листа');

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
            'sroc_obucheniya_id1111', 'main_plan', 'sroc_education_id', 'sroc_education', 'id'
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
