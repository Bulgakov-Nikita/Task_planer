<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id Первичный ключ
 * @property int $comp2_id ссылка на компетенцию 2
 * @property int $kurs_id ссылка на курсы
 * @property int $kafedra_id ссылка на кафедру
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Form[] $forms
 * @property Comp2 $comp2
 * @property Kafedra $kafedra
 * @property Kurs $kurs
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
            'comp2_id' => 'Comp2 ID',
            'kurs_id' => 'Kurs ID',
            'kafedra_id' => 'Kafedra ID',
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
     * Gets query for [[Forms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasMany(Form::className(), ['plan_id' => 'id']);
    }

    /**
     * Gets query for [[Comp2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp2()
    {
        return $this->hasOne(Comp2::className(), ['id' => 'comp2_id']);
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
     * Gets query for [[Kurs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKurs()
    {
        return $this->hasOne(Kurs::className(), ['id' => 'kurs_id']);
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
