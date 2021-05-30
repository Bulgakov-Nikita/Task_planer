<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "calendary".
 *
 * @property int $id Первичный ключ
 * @property int $kurs_id Ссылка на курсы
 * @property int $period_id Ссылка на периоды
 * @property int $main_plan_id ссылка на главную таблицу
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property User $createdBy
 * @property User $deletedBy
 * @property Kurs $kurs
 * @property MainPlan $mainPlan
 * @property Period $period
 * @property User $updatedBy
 */
class Calendary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calendary';
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
            'kurs_id' => 'Kurs ID',
            'period_id' => 'Period ID',
            'main_plan_id' => 'Main Plan ID',
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
     * Gets query for [[Kurs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKurs()
    {
        return $this->hasOne(Kurs::className(), ['id' => 'kurs_id']);
    }

    /**
     * Gets query for [[MainPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMainPlan()
    {
        return $this->hasOne(MainPlan::className(), ['id' => 'main_plan_id']);
    }

    /**
     * Gets query for [[Period]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['id' => 'period_id']);
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
}
