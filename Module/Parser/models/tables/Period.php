<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "period".
 *
 * @property int $id Первичный ключ
 * @property string $begin Дата начала периода
 * @property string $end Дата конца периода
 * @property int $semestr Семестр
 * @property int $course номер курса
 * @property int $type_periods_id внешний ключ
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
 * @property Calendary[] $calendaries
 * @property User $createdBy
 * @property User $deletedBy
 * @property User $deletedBy0
 * @property User $deletedBy1
 * @property TypePeriods $typePeriods
 * @property User $updatedBy
 * @property User $updatedBy0
 * @property User $updatedBy1
 * @property Staj[] $stajs
 */
class Period extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'period';
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
            'begin' => 'Begin',
            'end' => 'End',
            'semestr' => 'Semestr',
            'type_periods_id' => 'Type Periods ID',
            'main_plan_id' => 'Main Plan ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'active' => 'Active',
            'lock' => 'Lock',
            'course' => 'Course',
        ];
    }

    /**
     * Gets query for [[Calendaries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalendaries()
    {
        return $this->hasMany(Calendary::className(), ['period_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[DeletedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[DeletedBy1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy1()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[TypePeriods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypePeriods()
    {
        return $this->hasOne(TypePeriods::className(), ['id' => 'type_periods_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[UpdatedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[UpdatedBy1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy1()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Stajs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStajs()
    {
        return $this->hasMany(Staj::className(), ['period_id' => 'id']);
    }
}
