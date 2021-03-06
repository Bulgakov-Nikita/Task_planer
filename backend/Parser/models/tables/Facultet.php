<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "facultet".
 *
 * @property int $id Первичный ключ
 * @property string $name Название института
 * @property int $institut_id внешний ключ
 * @property int $create_at дата создания
 * @property int $create_by кем создано
 * @property int $update_at дата обновления
 * @property int $update_by кем создано
 * @property int|null $delete_at дата удаления
 * @property int|null $delete_by кем удалено
 * @property int $active статус
 * @property int $lock блокировка
 *
 * @property User $createBy
 * @property User $deleteBy
 * @property Institut $institut
 * @property User $updateBy
 * @property Kafedra[] $kafedras
 */
class Facultet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facultet';
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
            'name' => 'Name',
            'institut_id' => 'Institut ID',
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
     * Gets query for [[Institut]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitut()
    {
        return $this->hasOne(Institut::className(), ['id' => 'institut_id']);
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

    /**
     * Gets query for [[Kafedras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKafedras()
    {
        return $this->hasMany(Kafedra::className(), ['facultet_id' => 'id']);
    }
}
