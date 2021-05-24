<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "comp".
 *
 * @property int $id Первичный ключ
 * @property string $index индекс
 * @property string $soderzhanie содержание
 * @property int $type_comp_id ссылка на план
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property TypeComp $typeComp
 * @property Comp2[] $comp2s
 * @property Comp3[] $comp3s
 * @property Kk[] $kks
 */
class Comp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comp';
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
            'soderzhanie' => 'Soderzhanie',
            'type_comp_id' => 'Type Comp ID',
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
     * Gets query for [[TypeComp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeComp()
    {
        return $this->hasOne(TypeComp::className(), ['id' => 'type_comp_id']);
    }

    /**
     * Gets query for [[Comp2s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp2s()
    {
        return $this->hasMany(Comp2::className(), ['comp_id' => 'id']);
    }

    /**
     * Gets query for [[Comp3s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp3s()
    {
        return $this->hasMany(Comp3::className(), ['comp_id' => 'id']);
    }

    /**
     * Gets query for [[Kks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKks()
    {
        return $this->hasMany(Kk::className(), ['comp_id' => 'id']);
    }
}
