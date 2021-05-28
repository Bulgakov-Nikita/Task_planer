<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "comp_ps_has_comp".
 *
 * @property int $id Первичный ключ
 * @property int $comp_id ссылка на компетенции
 * @property int $comp_ps_id ссылка на компетенции 3
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property User $createBy
 * @property CompPs $compPs
 * @property Comp $comp
 * @property User $deleteBy
 * @property User $updateBy
 */
class CompPsHasComp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comp_ps_has_comp';
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
            'comp_id' => 'Comp ID',
            'comp_ps_id' => 'Comp Ps ID',
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
     * Gets query for [[CreateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[CompPs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompPs()
    {
        return $this->hasOne(CompPs::className(), ['id' => 'comp_ps_id']);
    }

    /**
     * Gets query for [[Comp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp()
    {
        return $this->hasOne(Comp::className(), ['id' => 'comp_id']);
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
