
<?php

use yii\db\Migration;

/**
 * Class m210519_120000_create_disciplines
 */
class m210519_120000_create_disciplines extends Migration
{

    public function safeUp()
    {
        $this->createTable('disciplines', [
            'id' => $this->primaryKey()->notNull()->comment('ПК для таблицы дисциплины'),
            'name' => $this->char(200)->comment('Название дисциплины'),
            'number_disciplinescol' => $this->char(45)->comment('Код дисциплины'),
            'create_at' => $this->integer(11)->notNull()->comment('дата создания'),
            'create_by' => $this->integer(11)->notNull()->comment('кем создано'),
            'update_at' => $this->integer(11)->notNull()->comment('дата редактирования'),
            'update_by' => $this->integer(11)->notNull()->comment('кем радактировано'),
            'delete_at' => $this->integer(11)->notNull()->comment('дата удаления'),
            'delete_by' => $this->integer(11)->notNull()->comment('кем удалено'),
            'active' => $this->tinyInteger(1)->notNull()->comment('статус'),
            'lock' => $this->integer(11)->notNull()->comment('блокировка'),
        ]);
        $this->addCommentOnTable('disciplines', 'Виды дисциплин');
    }

    public function safeDown()
    {
        $this->dropTable('disciplines');
    }
}