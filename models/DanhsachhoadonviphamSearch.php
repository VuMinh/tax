<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Danhsachhoadonvipham;

/**
 * DanhsachhoadonviphamSearch represents the model behind the search form about `app\models\Danhsachhoadonvipham`.
 */
class DanhsachhoadonviphamSearch extends Danhsachhoadonvipham
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mstDnMua', 'mstDnBan'], 'integer'],
            [['ngayBaoCao', 'coQuanQuanLyThueDnMua', 'kyHieuHoaDon', 'soHoaDon', 'ngayPhatHanhHoaDon', 'tenHangHoa', 'dauHieuViPham', 'tenChuDn', 'cmt', 'ngayThayDoiChuSoHuuGanNhat', 'ngayThayDoiDiaDiemGanNhat', 'thongBaoBoTron', 'ngayBoTron', 'coQuanThueQuanLyDnBan', 'coQuanThueRaQdxl', 'ghiChu', 'ghiChu1', 'ghiChu2'], 'safe'],
            [['giaTriHangChuaThue', 'thueVat'], 'number'],
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
        $query = Danhsachhoadonvipham::find()->orderBy(['(id)' => SORT_DESC]);

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

        $query->joinWith('mstDnMua0');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngayBaoCao' => $this->ngayBaoCao,
            'mstDnMua' => $this->mstDnMua,
            'ngayPhatHanhHoaDon' => $this->ngayPhatHanhHoaDon,
            'giaTriHangChuaThue' => $this->giaTriHangChuaThue,
            'thueVat' => $this->thueVat,
            'ngayThayDoiChuSoHuuGanNhat' => $this->ngayThayDoiChuSoHuuGanNhat,
            'ngayThayDoiDiaDiemGanNhat' => $this->ngayThayDoiDiaDiemGanNhat,
            'ngayBoTron' => $this->ngayBoTron,
            'mstDnBan' => $this->mstDnBan,
        ]);

        $query->andFilterWhere(['like', 'coQuanQuanLyThueDnMua', $this->coQuanQuanLyThueDnMua])
            ->andFilterWhere(['like', 'kyHieuHoaDon', $this->kyHieuHoaDon])
            ->andFilterWhere(['like', 'soHoaDon', $this->soHoaDon])
            ->andFilterWhere(['like', 'tenHangHoa', $this->tenHangHoa])
            ->andFilterWhere(['like', 'dauHieuViPham', $this->dauHieuViPham])
            ->andFilterWhere(['like', 'tenChuDn', $this->tenChuDn])
            ->andFilterWhere(['like', 'cmt', $this->cmt])
            ->andFilterWhere(['like', 'thongBaoBoTron', $this->thongBaoBoTron])
            ->andFilterWhere(['like', 'coQuanThueQuanLyDnBan', $this->coQuanThueQuanLyDnBan])
            ->andFilterWhere(['like', 'coQuanThueRaQdxl', $this->coQuanThueRaQdxl]);

        $query->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->ghiChu])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->ghiChu1]);

        return $dataProvider;
    }
}
