<?php

namespace app\modules\admin\Parser\models\tables;

use Yii;

/**
 * This is the model class for table "sprav_facultet".
 *
 * @property int $id Первичный ключ
 * @property string $name Название института
 * @property int $institut_id внешний ключ
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
 * @property Institut $institut
 * @property User $updateBy
 * @property SpravKafedra[] $spravKafedras
 */
class SpravFacultet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sprav_facultet';
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
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[SpravKafedras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpravKafedras()
    {
        return $this->hasMany(SpravKafedra::className(), ['sprav_facultet_id' => 'id']);
    }
}
