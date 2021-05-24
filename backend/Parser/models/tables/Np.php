<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "np".
 *
 * @property int $id Первичный ключ
 * @property int $code Код
 * @property int $name Название направления подготовки
 * @property int $prof_standart_id ссылка на проф стандарт
 * @property int $type_task_pd_id ссылка на Тип задачи проф деятельности
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property MainPlan[] $mainPlans
 * @property ProfStandart $profStandart
 * @property TypeTaskPd $typeTaskPd
 */
class Np extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'np';
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
            'prof_standart_id' => 'Prof Standart ID',
            'type_task_pd_id' => 'Type Task Pd ID',
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
     * Gets query for [[MainPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMainPlans()
    {
        return $this->hasMany(MainPlan::className(), ['np_id' => 'id']);
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
     * Gets query for [[TypeTaskPd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTaskPd()
    {
        return $this->hasOne(TypeTaskPd::className(), ['id' => 'type_task_pd_id']);
    }
}
