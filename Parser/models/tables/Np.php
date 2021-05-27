<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "np".
 *
 * @property int $id Первичный ключ
 * @property string $code Код
 * @property string $name Название направления подготовки
 * @property int|null $comp_ps_id ссылка на проф стандарт
 * @property int $type_task_pd_id ссылка на Тип задачи проф деятельности
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int|null $delete_at дата удаления
 * @property int|null $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property MainPlan[] $mainPlans
 * @property User $createBy
 * @property User $deleteBy
 * @property CompPs $compPs
 * @property TypeTaskPd $typeTaskPd
 * @property User $updateBy
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
        return [
            [['code', 'name', 'type_task_pd_id', 'create_at', 'create_by', 'update_at', 'update_by', 'active', 'lock'], 'required'],
            [['comp_ps_id', 'type_task_pd_id', 'create_at', 'create_by', 'update_at', 'update_by', 'delete_at', 'delete_by', 'active', 'lock'], 'integer'],
            [['code', 'name'], 'string', 'max' => 45],
            [['create_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_by' => 'id']],
            [['delete_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['delete_by' => 'id']],
            [['comp_ps_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompPs::className(), 'targetAttribute' => ['comp_ps_id' => 'id']],
            [['type_task_pd_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeTaskPd::className(), 'targetAttribute' => ['type_task_pd_id' => 'id']],
            [['update_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['update_by' => 'id']],
        ];
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
            'comp_ps_id' => 'Comp Ps ID',
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
     * Gets query for [[CreateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }

    /**
     * Gets query for [[DeleteBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeleteBy()
    {
        return $this->hasOne(User::className(), ['id' => 'delete_by']);
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
     * Gets query for [[TypeTaskPd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeTaskPd()
    {
        return $this->hasOne(TypeTaskPd::className(), ['id' => 'type_task_pd_id']);
    }

    /**
     * Gets query for [[UpdateBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'update_by']);
    }
}
