<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BaocaobaohiemxahoiSearch represents the model behind the search form about `app\models\Baocaobaohiemxahoi`.
 */
class BaocaobaohiemxahoiSearch extends Baocaobaohiemxahoi
{
    /** @var string $truongDoan */
    /** @var string $soQdxl */
    /** @var string $nguoiNopThue */
    /** @var string $maSoThue */
    public $truongDoan;
    public $soQdxl;
    public $nguoiNopThue;
    public $maSoThue;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'viPhamBhxh', 'viPhamKpcd', 'coKtndKpcd', 'coKtndBhxh', 'soDvThanhTraKiemTraHoanThanh'], 'integer'],
            [['ghiChu', 'phongChiCucThue', 'mst', 'soQdxlId'], 'safe'],
            [['truongDoan', 'soQdxl', 'nguoiNopThue', 'maSoThue'], 'string'],
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
//            'mst' => $this->mst,
//            'soQdxlId' => $this->soQdxlId,
            'viPhamBhxh' => $this->viPhamBhxh,
            'viPhamKpcd' => $this->viPhamKpcd,
            'coKtndKpcd' => $this->coKtndKpcd,
            'coKtndBhxh' => $this->coKtndBhxh,
            'soDvThanhTraKiemTraHoanThanh' => $this->soDvThanhTraKiemTraHoanThanh,
        ]);

        $query->joinWith('mst0');
        $query->joinWith('soQdxl');

        $query->andFilterWhere(['like', 'phongChiCucThue', $this->phongChiCucThue])
            ->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->mst])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->ghiChu])
            ->andFilterWhere(['like', 'quyetdinhxuly.soQdXuLy', $this->soQdxlId])
            ->andFilterWhere(['like', 'truongDoan', $this->truongDoan]);

        return $dataProvider;
    }
}
