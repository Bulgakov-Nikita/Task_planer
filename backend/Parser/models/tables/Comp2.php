<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "comp2".
 *
 * @property int $id Первичный ключ
 * @property string $index индекс
 * @property string $name название компетенции 2
 * @property int $comp_id ссылка на компетенцию
 * @property int $parent_id ссылка самого на себя
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Comp $comp
 * @property Comp2 $parent
 * @property Comp2[] $comp2s
 * @property Plan[] $plans
 */
class Comp2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comp2';
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
            'name' => 'Name',
            'comp_id' => 'Comp ID',
            'parent_id' => 'Parent ID',
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
     * Gets query for [[Comp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp()
    {
        return $this->hasOne(Comp::className(), ['id' => 'comp_id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comp2::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Comp2s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp2s()
    {
        return $this->hasMany(Comp2::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['comp2_id' => 'id']);
    }
}
