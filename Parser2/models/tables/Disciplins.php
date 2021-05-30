<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "disciplins".
 *
 * @property int $id Первичный ключ
 * @property string $index индекс
 * @property int|null $parent_id ссылка самого на себя
 * @property int $sprav_dis_id ссылка на компетенцию
 * @property int $plan_id comment in light future
 * @property int $sprav_kafedra_id comment in light future
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Dc[] $dcs
 * @property User $createBy
 * @property Plan $plan
 * @property SpravKafedra $spravKafedra
 * @property SpravDis $spravDis
 * @property User $deleteBy
 * @property Disciplins $parent
 * @property Disciplins[] $disciplins
 * @property User $updateBy
 */
class Disciplins extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disciplins';
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
            'parent_id' => 'Parent ID',
            'sprav_dis_id' => 'Sprav Dis ID',
            'plan_id' => 'Plan ID',
            'sprav_kafedra_id' => 'Sprav Kafedra ID',
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
     * Gets query for [[Dcs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDcs()
    {
        return $this->hasMany(Dc::className(), ['disciplins_id' => 'id']);
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
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[SpravKafedra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravKafedra()
    {
        return $this->hasOne(SpravKafedra::className(), ['id' => 'sprav_kafedra_id']);
    }

    /**
     * Gets query for [[SpravDis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravDis()
    {
        return $this->hasOne(SpravDis::className(), ['id' => 'sprav_dis_id']);
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
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Disciplins::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Disciplins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplins()
    {
        return $this->hasMany(Disciplins::className(), ['parent_id' => 'id']);
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
