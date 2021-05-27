<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id Первичный ключ
 * @property string $FIO Фамилия имя отчество
 * @property string $post должность
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int|null $delete_at дата удаления
 * @property int|null $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property MainPlan[] $mainPlans
 * @property Podpisants[] $podpisants
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
            'FIO' => 'Fio',
            'post' => 'Post',
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
     * Gets query for [[CreateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }

    /**
     * Gets query for [[DeleteBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeleteBy()
    {
        return $this->hasOne(User::className(), ['id' => 'delete_by']);
    }

    /**
     * Gets query for [[UpdateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'update_by']);
    }
}
