<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "main_plan".
 *
 * @property int $id Первичный ключ
 * @property string $date_sp год начала подготовки
 * @property string $date_education год обучения
 * @property string|null $date_ut дата утверждения
 * @property string $name_or название организации
 * @property string $name_ministry название министерства
 * @property string $n_protocol номер протокола
 * @property string $date_protocol дата протокола
 * @property int $fgos_id id стандарта
 * @property int $sprav_kafedra_id id реквизита
 * @property int $kvalification_id id уровня обучения
 * @property int $np_id id направления
 * @property int $fo_id id формы обучения
 * @property int $staff_id
 * @property int $sroc_education_id id срока обучения
 * @property int $sprav_uch_god_id id срока справ уч года
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
 * @property Comp[] $comps
 * @property User $createdBy
 * @property User $deletedBy
 * @property User $updatedBy
 * @property Fgos $fgos
 * @property Fo $fo
 * @property Kvalification $kvalification
 * @property Np $np
 * @property SpravKafedra $spravKafedra
 * @property SpravUchGod $spravUchGod
 * @property SrocEducation $srocEducation
 * @property Staff $staff
 * @property Nid[] $ns
 * @property Plan[] $plans
 * @property Podpisants[] $podpisants
 */
class MainPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_plan';
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
            'date_sp' => 'Date Sp',
            'date_education' => 'Date Education',
            'date_ut' => 'Date Ut',
            'name_or' => 'Name Or',
            'name_ministry' => 'Name Ministry',
            'n_protocol' => 'N Protocol',
            'date_protocol' => 'Date Protocol',
            'fgos_id' => 'Fgos ID',
            'sprav_kafedra_id' => 'Sprav Kafedra ID',
            'kvalification_id' => 'Kvalification ID',
            'np_id' => 'Np ID',
            'fo_id' => 'Fo ID',
            'staff_id' => 'Staff ID',
            'sroc_education_id' => 'Sroc Education ID',
            'sprav_uch_god_id' => 'Sprav Uch God ID',
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
     * Gets query for [[Calendaries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalendaries()
    {
        return $this->hasMany(Calendary::className(), ['main_plan_id' => 'id']);
    }

    /**
     * Gets query for [[Comps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComps()
    {
        return $this->hasMany(Comp::className(), ['main_plan_id' => 'id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Fgos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFgos()
    {
        return $this->hasOne(Fgos::className(), ['id' => 'fgos_id']);
    }

    /**
     * Gets query for [[Fo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFo()
    {
        return $this->hasOne(Fo::className(), ['id' => 'fo_id']);
    }

    /**
     * Gets query for [[Kvalification]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKvalification()
    {
        return $this->hasOne(Kvalification::className(), ['id' => 'kvalification_id']);
    }

    /**
     * Gets query for [[Np]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNp()
    {
        return $this->hasOne(Np::className(), ['id' => 'np_id']);
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
     * Gets query for [[SpravUchGod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravUchGod()
    {
        return $this->hasOne(SpravUchGod::className(), ['id' => 'sprav_uch_god_id']);
    }

    /**
     * Gets query for [[SrocEducation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSrocEducation()
    {
        return $this->hasOne(SrocEducation::className(), ['id' => 'sroc_education_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }

    /**
     * Gets query for [[Ns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNs()
    {
        return $this->hasMany(Nid::className(), ['main_plan_id' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['main_plan_id' => 'id']);
    }

    /**
     * Gets query for [[Podpisants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPodpisants()
    {
        return $this->hasMany(Podpisants::className(), ['main_plan_id' => 'id']);
    }
}
