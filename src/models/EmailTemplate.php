<?php

namespace tmukherjee13\mailer\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%email_templates}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $subject
 * @property string $body
 * @property integer $status
 * @property string $created
 * @property string $updated
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    use \tmukherjee13\mailer\MailerTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email_template}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
         {
             return [
                 'timestamp' => [
                     'class' => 'yii\behaviors\TimestampBehavior',
                     'createdAtAttribute' => 'created',
                     'updatedAtAttribute' => 'updated',
                     'value' => new Expression('NOW()'),
                     'attributes' => [
                         \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                         \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                     ],
                 ],
             ];
         }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['body'], 'string'],
            [['status'], 'integer'],
            [['created','updated'], 'safe'],
            [['code', 'subject'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'status' => Yii::t('app', 'Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function compile($data)
    {
        // echo "<pre>";
        // print_r($this->body);
        // echo "</pre>";
        // die;
        return $this->_compileEmail($this,$data);
    }
}
