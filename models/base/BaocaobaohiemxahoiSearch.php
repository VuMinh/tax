<?php

namespace app\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\base\Baocaobaohiemxahoi;

/**
 * BaocaobaohiemxahoiSearch represents the model behind the search form about `app\models\base\Baocaobaohiemxahoi`.
 */
class BaocaobaohiemxahoiSearch extends Baocaobaohiemxahoi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mst', 'soQdxlId', 'viPhamBhxh', 'viPhamKpcd', 'coKtndKpcd', 'coKtndBhxh', 'soDvThanhTraKiemTraHoanThanh'], 'integer'],
            [['ghiChu', 'phongChiCucThue'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Baocaobaohiemxahoi::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'mst' => $this->mst,
            'soQdxlId' => $this->soQdxlId,
            'viPhamBhxh' => $this->viPhamBhxh,
            'viPhamKpcd' => $this->viPhamKpcd,
            'coKtndKpcd' => $this->coKtndKpcd,
            'coKtndBhxh' => $this->coKtndBhxh,
            'soDvThanhTraKiemTraHoanThanh' => $this->soDvThanhTraKiemTraHoanThanh,
        ]);

        $query->andFilterWhere(['like', 'ghiChu', $this->ghiChu])
            ->andFilterWhere(['like', 'phongChiCucThue', $this->phongChiCucThue]);

        return $dataProvider;
    }
}
