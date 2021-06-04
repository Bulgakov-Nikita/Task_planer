<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id Первичный ключ
 * @property string $f Фамилия имя отчество Ф
 * @property string $i Фамилия имя отчество И
 * @property string $o Фамилия имя отчество О
 * @property string $OO о?
 * @property int|null $user_id юзер id
 * @property string $post должность
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property MainPlan[] $mainPlans
 * @property Podpisants[] $podpisants
 * @property Prepod[] $prepods
 * @property User $createBy
 * @property User $deleteBy
 * @property User $updateBy
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
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
            'f' => 'F',
            'i' => 'I',
            'o' => 'O',
            'OO' => 'Oo',
            'user_id' => 'User ID',
            'post' => 'Post',
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
     * Gets query for [[MainPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMainPlans()
    {
        return $this->hasMany(MainPlan::className(), ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[Podpisants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPodpisants()
    {
        return $this->hasMany(Podpisants::className(), ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[Prepods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrepods()
    {
        return $this->hasMany(Prepod::className(), ['staff_id' => 'id']);
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
}
