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
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int $delete_at дата удаления
 * @property int $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property Plan $plan
 * @property TypeSession $typeSession
 * @property TypeWork $typeWork
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
}
