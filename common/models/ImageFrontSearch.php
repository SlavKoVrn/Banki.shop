<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Image;

/**
 * ImageFrontSearch represents the model behind the search form of `common\models\Image`.
 */
class ImageFrontSearch extends Image
{
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

        $query->orFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'slug', $this->name])
            ->orFilterWhere(['like', 'mime', $this->name])
            ->orFilterWhere(['like', 'size', $this->name])
            ->orFilterWhere(['like', 'datetime', $this->name]);

        return $dataProvider;
    }
}
