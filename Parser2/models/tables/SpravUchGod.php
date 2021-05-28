<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "sprav_uch_god".
 *
 * @property int $id Первичный ключ
 * @property string $name Название?
 * @property int|null $year_begin Год начала учебного года
 * @property int|null $year_end Год конца учебного года
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 */
class SpravUchGod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sprav_uch_god';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year_begin' => 'Year Begin',
            'year_end' => 'Year End',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'active' => 'Active',
            'lock' => 'Lock',
        ];
    }
}
