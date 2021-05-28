<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "sprav_kafedra".
 *
 * @property int $id Первичный ключ
 * @property string $name Название института
 * @property int $sprav_facultet_id внешний ключ
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Disciplins[] $disciplins
 * @property KafHasComp[] $kafHasComps
 * @property MainPlan[] $mainPlans
 * @property Plan[] $plans
 * @property SpravDis[] $spravDis
 * @property User $createBy
 * @property User $deleteBy
 * @property SpravFacultet $spravFacultet
 * @property User $updateBy
 */
class SpravKafedra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sprav_kafedra';
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
            'sprav_facultet_id' => 'Sprav Facultet ID',
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
     * Gets query for [[Disciplins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplins()
    {
        return $this->hasMany(Disciplins::className(), ['sprav_kafedra_id' => 'id']);
    }

    /**
     * Gets query for [[KafHasComps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKafHasComps()
    {
        return $this->hasMany(KafHasComp::className(), ['sprav_kafedra_id' => 'id']);
    }

    /**
     * Gets query for [[MainPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMainPlans()
    {
        return $this->hasMany(MainPlan::className(), ['sprav_kafedra_id' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['sprav_kafedra_id' => 'id']);
    }

    /**
     * Gets query for [[SpravDis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravDis()
    {
        return $this->hasMany(SpravDis::className(), ['sprav_kafedra_id' => 'id']);
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
     * Gets query for [[SpravFacultet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravFacultet()
    {
        return $this->hasOne(SpravFacultet::className(), ['id' => 'sprav_facultet_id']);
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
}
