<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "main_plan".
 *
 * @property int $id Первичный ключ
 * @property string $date_sp год начала подготовки
 * @property string $date_education год обучения
 * @property string $date_ut дата утверждения
 * @property string $name_or название организации
 * @property string $name_ministry название министерства
 * @property string $n_protocol номер протокола
 * @property string $date_protocol дата протокола
 * @property int $fgos_id id стандарта
 * @property int $kafedra_id id реквизита
 * @property int $kvalification_id id уровня обучения
 * @property int $np_id id направления
 * @property int $fo_id id формы обучения
 * @property int $staff_id
 * @property int $sroc_education_id id срока обучения
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Comp3[] $comp3s
 * @property Fgos $fgos
 * @property Fo $fo
 * @property Kafedra $kafedra
 * @property Kvalification $kvalification
 * @property Np $np
 * @property SrocEducation $srocEducation
 * @property Staff $staff
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
            'kafedra_id' => 'Kafedra ID',
            'kvalification_id' => 'Kvalification ID',
            'np_id' => 'Np ID',
            'fo_id' => 'Fo ID',
            'staff_id' => 'Staff ID',
            'sroc_education_id' => 'Sroc Education ID',
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
     * Gets query for [[Comp3s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp3s()
    {
        return $this->hasMany(Comp3::className(), ['main_plan_id' => 'id']);
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
     * Gets query for [[Kafedra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKafedra()
    {
        return $this->hasOne(Kafedra::className(), ['id' => 'kafedra_id']);
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
     * Gets query for [[Podpisants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPodpisants()
    {
        return $this->hasMany(Podpisants::className(), ['main_plan_id' => 'id']);
    }
}
