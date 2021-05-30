<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id Первичный ключ
 * @property int $main_plan_id ссылка на компетенцию 2
 * @property int $kurs_id ссылка на курсы
 * @property int $sprav_kafedra_id ссылка на кафедру
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
 * @property Form[] $forms
 * @property User $createdBy
 * @property MainPlan $mainPlan
 * @property User $deletedBy
 * @property SpravKafedra $spravKafedra
 * @property Kurs $kurs
 * @property User $updatedBy
 * @property Session[] $sessions
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
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
            'main_plan_id' => 'Main Plan ID',
            'kurs_id' => 'Kurs ID',
            'sprav_kafedra_id' => 'Sprav Kafedra ID',
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
     * Gets query for [[Disciplins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplins()
    {
        return $this->hasMany(Disciplins::className(), ['plan_id' => 'id']);
    }

    /**
     * Gets query for [[Forms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasMany(Form::className(), ['plan_id' => 'id']);
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
     * Gets query for [[MainPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMainPlan()
    {
        return $this->hasOne(MainPlan::className(), ['id' => 'main_plan_id']);
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
     * Gets query for [[SpravKafedra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravKafedra()
    {
        return $this->hasOne(SpravKafedra::className(), ['id' => 'sprav_kafedra_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['plan_id' => 'id']);
    }
}
