<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "prof_standart".
 *
 * @property int $id Первичный ключ
 * @property int $code Код
 * @property int $name Название проф стандарта
 * @property string $date дата проф стандарта
 * @property string $number номер проф стандарта
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
 * @property Np[] $nps
 * @property ProfStandart $parent
 * @property ProfStandart[] $profStandarts
 */
class ProfStandart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prof_standart';
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
            'code' => 'Code',
            'name' => 'Name',
            'date' => 'Date',
            'number' => 'Number',
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
     * Gets query for [[Nps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNps()
    {
        return $this->hasMany(Np::className(), ['prof_standart_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ProfStandart::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ProfStandarts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfStandarts()
    {
        return $this->hasMany(ProfStandart::className(), ['parent_id' => 'id']);
    }
}
