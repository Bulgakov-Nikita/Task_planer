
<?php

use yii\db\Migration;

/**
 * Class m210519_121407_create_plan
 */
class m210519_121407_create_plan extends Migration
{
    public function safeUp()
    {
        $this->createTable('plan', [
            'id' => $this->primaryKey()->notNull()->comment('ПК для таблицы план'),
            'number_of_hours' => $this->char(45)->comment('Кол-во часов'),
            'zet' => $this->char(45)->comment('Кол-во зачётных часов'),
            'kafedra_id' => $this->integer()->notNull()->comment('Внешний ключ на kafedra_id'),
            'disciplines_id' => $this->integer()->notNull()->comment('Внешний ключ на disciplines_id'),
            'control_and_certification_id' => $this->integer()->notNull()->comment('Внешний ключ на control_and_certification_id'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('plan', 'Таблица с данными по дисциплинам, кафедрам, аттестации
                                                        и часам обучения');

        $this->addForeignKey(
            'fk-disciplines-id',
            'plan',
            'disciplines_id',
            'disciplines',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-control_and_certification-id',
            'plan',
            'control_and_certification_id',
            'control_and_certification',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-kafedra_id',
            'plan',
            'kafedra_id',
            'kafedra',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('plan');

        $this->dropForeignKey(
            'fk-kafedra-id',
            'kafedra'
        );

        $this->dropForeignKey(
            'fk-disciplines-id',
            'disciplines'
        );

        $this->dropForeignKey(
            'fk-control_and_certification-id',
            'control_and_certification'
        );
    }
}