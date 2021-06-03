<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property string|null $data
 * @property int $type_session_id
 * @property int $type_work_id
 * @property int $disciplins_id
 * @property int $kurs_id
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $active
 * @property int $lock
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
            'disciplins_id' => 'Disciplins ID',
            'kurs_id' => 'Kurs ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'active' => 'Active',
            'lock' => 'Lock',
        ];
    }
}
