<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id Первичный ключ
 * @property string $data данные
 * @property int $type_session_id ссылка на тип сессии
 * @property int $type_work_id ссылка на тип работы
 * @property int $plan_id ссылка на план
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
 * @property User $deleteBy
 * @property Plan $plan
 * @property TypeSession $typeSession
 * @property TypeWork $typeWork
 * @property User $updateBy
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
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
            'data' => 'Data',
            'type_session_id' => 'Type Session ID',
            'type_work_id' => 'Type Work ID',
            'plan_id' => 'Plan ID',
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
     * Gets query for [[DeleteBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeleteBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[Plan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    /**
     * Gets query for [[TypeSession]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeSession()
    {
        return $this->hasOne(TypeSession::className(), ['id' => 'type_session_id']);
    }

    /**
     * Gets query for [[TypeWork]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeWork()
    {
        return $this->hasOne(TypeWork::className(), ['id' => 'type_work_id']);
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
