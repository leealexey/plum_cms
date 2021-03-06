<?php

namespace app\modules\admin\models;

use yii\data\ActiveDataProvider;

/**
 * SystemLogSearch represents the model behind the search form about `backend\models\SystemLog`.
 */
class SystemLogSearch extends SystemLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_time', 'message'], 'integer'],
            [['category', 'prefix', 'level'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SystemLog::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'level' => $this->level,
            'log_time' => $this->log_time,
            'message' => $this->message,
        ]);
        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'prefix', $this->prefix]);
        return $dataProvider;
    }
}