<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "comp".
 *
 * @property int $id Первичный ключ
 * @property string $index индекс
 * @property string $soderzhanie содержание
 * @property int $main_plan_id внешний ключ
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property User $createBy
 * @property User $deleteBy
 * @property User $updateBy
 * @property CompPsHasComp[] $compPsHasComps
 * @property Dc[] $dcs
 * @property Kk[] $kks
 */
class Comp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comp';
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
            'index' => 'Index',
            'soderzhanie' => 'Soderzhanie',
            'main_plan_id' => 'Main Plan Id',
            'created_at' => 'Create At',
            'created_by' => 'Create By',
            'updated_at' => 'Update At',
            'updated_by' => 'Update By',
            'deleted_at' => 'Delete At',
            'deleted_by' => 'Delete By',
            'active' => 'Active',
            'lock' => 'Lock',
        ];
    }

    /**
     * Gets query for [[CreateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DeleteBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeleteBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[UpdateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[CompPsHasComps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompPsHasComps()
    {
        return $this->hasMany(CompPsHasComp::className(), ['comp_id' => 'id']);
    }

    /**
     * Gets query for [[Dcs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDcs()
    {
        return $this->hasMany(Dc::className(), ['comp_id' => 'id']);
    }

    /**
     * Gets query for [[Kks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKks()
    {
        return $this->hasMany(Kk::className(), ['comp_id' => 'id']);
    }
}
