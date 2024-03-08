<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int|null $size
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $mime
 * @property string|null $path
 * @property string|null $datetime
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size'], 'integer'],
            [['datetime'], 'safe'],
            [['name', 'slug', 'mime', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'name' => 'Наименование',
            'size' => 'Размер',
            'slug' => 'Транслит',
            'mime' => 'Mime',
            'path' => 'Путь',
            'datetime' => 'Дата и время загрузки',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['datetime'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'slug' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
             ],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->datetime = date('d.m.Y H:i', strtotime($this->datetime));
    }
}
