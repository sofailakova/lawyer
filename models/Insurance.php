<?php

namespace app\models;

use app\components\events\EventInsuranceCreate;
use Yii;

/**
 * This is the model class for table "insurance".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $create_at
 * @property string $max_at
 *
 * @property User $user
 * @property DataAttachments $id0
 * @property Work[] $works
 */
class Insurance extends \yii\db\ActiveRecord
{
    public $date_diff;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insurance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'description'], 'required'],
            [['user_id'], 'integer'],
            [['description'], 'string'],
            [['create_at', 'max_at'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            //[['id'], 'exist', 'skipOnError' => true, 'targetClass' => DataAttachments::className(), 'targetAttribute' => ['id' => 'model_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'userName' => 'Приклепленный пользователь',
            'name' => 'Название',
            'description' => 'Описание',
            'create_at' => 'Дата создания',
            'max_at' => 'Назначено до',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert || isset($changedAttributes['user_id'])){
            (new EventInsuranceCreate($this->user_id, $this->id, $this->name))->trigger();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserName()
    {
        return $this->user ? $this->user->username : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['insurance_id' => 'id']);
    }
}
