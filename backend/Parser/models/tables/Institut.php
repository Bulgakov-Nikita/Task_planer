<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "institut".
 *
 * @property int $id Первичный ключ
 * @property string $name Название института
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Facultet[] $facultets
 */
class Institut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institut';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_at' => 'Create At',
            'create_by' => 'Create By',
            'update_at' => 'Update At',
            'update_by' => 'Update By',
            'delete_at' => 'Delete At',
            'delete_by' => 'Delete By',
            'active' => 'Active',
            'lock' => 'Lock',
        ];
    }

    /**
     * Gets query for [[Facultets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacultets()
    {
        return $this->hasMany(Facultet::className(), ['institut_id' => 'id']);
    }
}
