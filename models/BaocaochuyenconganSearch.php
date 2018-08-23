<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Baocaochuyencongan;

/**
 * BaocaochuyenconganSearch represents the model behind the search form about `app\models\Baocaochuyencongan`.
 */
class BaocaochuyenconganSearch extends Baocaochuyencongan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mst', 'tongSoHoaDon'], 'integer'],
            [['phongChiCuc', 'soKetLuanThanhKiemTraDaBanHanh', 'ngayBaoCao', 'ngayCapNhat', 'ngayKetLuan', 'ghiChu', 'ghiChu1', 'ghiChu2'], 'safe'],
            [['doanhSo', 'thueGtgt'], 'number'],
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
        $query = Baocaochuyencongan::find();

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

        $query->joinWith('mst0');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'mst' => $this->mst,
            'doanhSo' => $this->doanhSo,
            'thueGtgt' => $this->thueGtgt,
            'tongSoHoaDon' => $this->tongSoHoaDon,
            'ngayBaoCao' => $this->ngayBaoCao,
            'ngayCapNhat' => $this->ngayCapNhat,
            'ngayKetLuan' => $this->ngayKetLuan,
        ]);

        $query->andFilterWhere(['like', 'phongChiCuc', $this->phongChiCuc])
            ->andFilterWhere(['like', 'soKetLuanThanhKiemTraDaBanHanh', $this->soKetLuanThanhKiemTraDaBanHanh])
            ->andFilterWhere(['like', 'ghiChu', $this->ghiChu])
            ->andFilterWhere(['like', 'ghiChu2', $this->ghiChu2]);

        $query->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->ghiChu1]);

        return $dataProvider;
    }
}
