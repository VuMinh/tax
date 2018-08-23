<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Baocaothanhtra;

/**
 * BaocaothanhtraSearch represents the model behind the search form about `app\models\Baocaothanhtra`.
 */
class BaocaothanhtraSearch extends Baocaothanhtra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['truongDoan', 'mst', 'soQdThanhTraId', 'soQdTruyThuId', 'vatTruyThu', 'doiKiemTra'], 'safe'],
            [['tndn', 'ttdb', 'tncn', 'monBai', 'tienPhat1020', 'tienPhat005'], 'number'],
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
        $query = Baocaothanhtra::find()->orderBy(['(id)' => SORT_DESC]);

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
        $query->joinWith('soQdTruyThu');
        $query->joinWith('mst0');
        $query->joinWith('soQdThanhTra');
//        $query->joinWith('lichsunopthanhtras');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'soQdThanhTraId' => $this->soQdThanhTraId,
//            'mst' => $this->mst,
            'vatTruyThu' => $this->vatTruyThu,
            'tndn' => $this->tndn,
            'ttdb' => $this->ttdb,
            'tncn' => $this->tncn,
            'monBai' => $this->monBai,
            'tienPhat1020' => $this->tienPhat1020,
            'tienPhat005' => $this->tienPhat005,
//            'soQdTruyThuId' => $this->soQdTruyThuId,
        ]);

        $query->andFilterWhere(['like', 'truongDoan', $this->truongDoan])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->doiKiemTra])
            ->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->mst])
            ->andFilterWhere(['like', 'quyetdinhthanhtra.soQdThanhTra', $this->soQdThanhTraId])
            ->andFilterWhere(['like', 'quyetdinhtruythu.soQdTruyThu', $this->soQdTruyThuId]);

        return $dataProvider;
    }
}
