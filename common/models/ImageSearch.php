<?php

namespace common\models;

use common\models\Image;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kartik\daterange\DateRangeBehavior;

/**
 * ImageSearch represents the model behind the search form of `common\models\Image`.
 */
class ImageSearch extends Image
{
    public $dateTimeStart,$dateTimeEnd;

    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::class,
                'attribute' => 'datetime',
                'dateStartAttribute' => 'dateTimeStart',
                'dateEndAttribute' => 'dateTimeEnd',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'size'], 'integer'],
            [['name', 'slug', 'mime', 'path', 'datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Image::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->datetime){
            $query->andFilterWhere(['between','UNIX_TIMESTAMP(datetime)',$this->dateTimeStart,$this->dateTimeEnd]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'mime', $this->mime])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
