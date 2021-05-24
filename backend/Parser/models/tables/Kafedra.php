<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "kafedra".
 *
 * @property int $id Первичный ключ
 * @property string $name Название института
 * @property int $facultet_id внешний ключ
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Facultet $facultet
 * @property Kk[] $kks
 * @property MainPlan[] $mainPlans
 * @property Plan[] $plans
 */
class Kafedra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kafedra';
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
            'facultet_id' => 'Facultet ID',
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
     * Gets query for [[Facultet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacultet()
    {
        return $this->hasOne(Facultet::className(), ['id' => 'facultet_id']);
    }

    /**
     * Gets query for [[Kks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKks()
    {
        return $this->hasMany(Kk::className(), ['kafedra_id' => 'id']);
    }

    /**
     * Gets query for [[MainPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMainPlans()
    {
        return $this->hasMany(MainPlan::className(), ['kafedra_id' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['kafedra_id' => 'id']);
    }
}
