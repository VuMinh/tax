<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\base\Sotheodoisauhoanthue;
/**
 * SoTheoDoiSauHoanThueSearch represents the model behind the search form about `app\models\base\SoTheoDoiSauHoanThue`.
 */
class SotheodoisauhoanthueSearch extends Sotheodoisauhoanthue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loaiHoanThueId', 'soQdThuHoiHoan'], 'integer'],
            [['maChuong', 'mst', 'thoiKyThanhTra', 'laToChuc', 'ghiChu', 'soQdThanhTraId', 'soQdKtId', 'soVbHoanThueId', 'soQdXuPhat', 'chiTietHanhViViPham'], 'safe'],
            [['soThueDeNghiHoan', 'soThueKhongDuocHoan'], 'number'],
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
        $query = Sotheodoisauhoanthue::find()->orderBy(['(id)' => SORT_DESC]);
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
        $query->joinWith('soQdThanhTra');
        $query->joinWith('soQdKt');
        $query->joinWith('soVbHoanThue');
        $query->andFilterWhere([
            'id' => $this->id,
            'loaiHoanThueId' => $this->loaiHoanThueId,
            'soThueDeNghiHoan' => $this->soThueDeNghiHoan,
            'soThueKhongDuocHoan' => $this->soThueKhongDuocHoan,
        ]);
        $query->andFilterWhere(['like', 'maChuong', $this->maChuong])
            ->andFilterWhere(['like', 'thoiKyThanhTra', $this->thoiKyThanhTra])
            ->andFilterWhere(['like', 'ghiChu', $this->ghiChu])
            ->andFilterWhere(['like', 'soQdXuPhat', $this->soQdXuPhat])
            ->andFilterWhere(['like', 'quyetdinhkiemtra.soQdKiemTra', $this->soQdKtId])
            ->andFilterWhere(['like', 'vanban.soVb', $this->soVbHoanThueId])
            ->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->mst])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->laToChuc])
            ->andFilterWhere(['like', 'quyetdinhthanhtra.soQdThanhTra', $this->soQdThanhTraId])
            ->andFilterWhere(['like', 'chiTietHanhViViPham', $this->chiTietHanhViViPham]);
        return $dataProvider;
    }
}
