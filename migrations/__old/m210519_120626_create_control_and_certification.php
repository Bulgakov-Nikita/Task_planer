<?php

use yii\db\Migration;

/**
 * Class m210519_120626_create_control_and_certification
 */
class m210519_120626_create_control_and_certification extends Migration
{
    public function safeUp()
    {
        $this->createTable('control_and_certification', [
            'id' => $this->primaryKey()->notNull()->comment('ПК для контроль_и_сертификация'),
            'name' => $this->char(45)->comment('Название'),
            'from' => $this->char(45)->comment('Форма проведения контроля и сертификации'),
            'type_work_id' => $this->integer()->notNull()->comment('Внешний ключ на work_id')
        ]);
        $this->addCommentOnTable('control_and_certification','Таблица для определения периода аттестации');

        $this->addForeignKey(
           'fk-control_and_certification-type_work_id',
            'control_and_certification',
            'type_work_id',
            'type_work',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('control_and_certification');

        $this->dropForeignKey(
            'fk-control_and_certification-type_work_id',
            'type_work'
        );
    }
}
