<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "comp_ps".
 *
 * @property int $id Первичный ключ
 * @property string $index индекс
 * @property string $name название компетенции 3
 * @property string|null $trebovanie требования
 * @property int|null $parent_id ссылка самого на себя
 * @property int $prof_standart_id номер и дата проф стандарта
 * @property int $created_at дата создания
 * @property int $created_by кем создано
 * @property int $updated_at дата обновления
 * @property int $updated_by кем создано
 * @property int|null $deleted_at дата удаления
 * @property int|null $deleted_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property ProfStandart $profStandart
 * @property User $createBy
 * @property User $deleteBy
 * @property CompPs $parent
 * @property CompPs[] $compPs
 * @property User $updateBy
 * @property CompPsHasComp[] $compPsHasComps
 * @property Np[] $nps
 */
class CompPs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comp_ps';
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
            'trebovanie' => 'Trebovanie',
            'parent_id' => 'Parent ID',
            'prof_standart_id' => 'Prof Standart ID',
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
     * Gets query for [[ProfStandart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfStandart()
    {
        return $this->hasOne(ProfStandart::className(), ['id' => 'prof_standart_id']);
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
     * Gets query for [[DeleteBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeleteBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CompPs::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[CompPs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompPs()
    {
        return $this->hasMany(CompPs::className(), ['parent_id' => 'id']);
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

    /**
     * Gets query for [[CompPsHasComps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompPsHasComps()
    {
        return $this->hasMany(CompPsHasComp::className(), ['comp_ps_id' => 'id']);
    }

    /**
     * Gets query for [[Nps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNps()
    {
        return $this->hasMany(Np::className(), ['comp_ps_id' => 'id']);
    }
}
