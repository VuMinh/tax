<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ketquakttaitrusonnt;

/**
 * KetquakttaitrusonntSearch represents the model behind the search form about `app\models\Ketquakttaitrusonnt`.
 */
class KetquakttaitrusonntSearch extends Ketquakttaitrusonnt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chiTieuKiemTraId', 'nguoiNopThueId', 'tienDoThucHien', 'loaiQuyMoDoanhNghiepId', 'loaiKhuVucDoanhNghiepId'], 'integer'],
            [['nhiemVuKiemTra', 'soQdkt', 'ngayQdkt', 'noiDungChuyenDe', 'soQdXuLy', 'ngayQdxl', 'soKetLuan', 'ngayKetLuan', 'doanhNghiepCoViPham', 'ngayTao', 'ngayCapNhat', 'ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4', 'ghiChu5', 'ghiChu6'], 'safe'],
            [['soThueTruyThuVat', 'soThueTruyThuTndn', 'soThueTruyThuTncn', 'soThueTruyThuTtdb', 'soThueTruyThuKhac', 'soThueKhongDuocHoan', 'soThueTruyHoan', 'anDinh', 'tienPhat', 'tienKkSai', 'tienPhatNopCham', 'tienPhatViPhamHanhChinhKhac', 'noDongNamTruoc', 'noPhatSinhTrongNam', 'daNopChoNoDongNamTruoc', 'daNopPhatSinhTrongNam', 'conPhaiNopDongNamTruoc', 'conPhaiNopPhatSinhTrongNam', 'soThueDuocGiamTheoKeKhai', 'soThueDuocGiamTheoTtkt', 'chenhLech', 'giamLo', 'giamKhauTru'], 'number'],
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
        $query = Ketquakttaitrusonnt::find();

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
            'chiTieuKiemTraId' => $this->chiTieuKiemTraId,
            'ngayQdkt' => $this->ngayQdkt,
            'nguoiNopThueId' => $this->nguoiNopThueId,
            'tienDoThucHien' => $this->tienDoThucHien,
            'ngayQdxl' => $this->ngayQdxl,
            'ngayKetLuan' => $this->ngayKetLuan,
            'loaiQuyMoDoanhNghiepId' => $this->loaiQuyMoDoanhNghiepId,
            'ngayTao' => $this->ngayTao,
            'ngayCapNhat' => $this->ngayCapNhat,
            'loaiKhuVucDoanhNghiepId' => $this->loaiKhuVucDoanhNghiepId,
            'soThueTruyThuVat' => $this->soThueTruyThuVat,
            'soThueTruyThuTndn' => $this->soThueTruyThuTndn,
            'soThueTruyThuTncn' => $this->soThueTruyThuTncn,
            'soThueTruyThuTtdb' => $this->soThueTruyThuTtdb,
            'soThueTruyThuKhac' => $this->soThueTruyThuKhac,
            'soThueKhongDuocHoan' => $this->soThueKhongDuocHoan,
            'soThueTruyHoan' => $this->soThueTruyHoan,
            'anDinh' => $this->anDinh,
            'tienPhat' => $this->tienPhat,
            'tienKkSai' => $this->tienKkSai,
            'tienPhatNopCham' => $this->tienPhatNopCham,
            'tienPhatViPhamHanhChinhKhac' => $this->tienPhatViPhamHanhChinhKhac,
            'noDongNamTruoc' => $this->noDongNamTruoc,
            'noPhatSinhTrongNam' => $this->noPhatSinhTrongNam,
            'daNopChoNoDongNamTruoc' => $this->daNopChoNoDongNamTruoc,
            'daNopPhatSinhTrongNam' => $this->daNopPhatSinhTrongNam,
            'conPhaiNopDongNamTruoc' => $this->conPhaiNopDongNamTruoc,
            'conPhaiNopPhatSinhTrongNam' => $this->conPhaiNopPhatSinhTrongNam,
            'soThueDuocGiamTheoKeKhai' => $this->soThueDuocGiamTheoKeKhai,
            'soThueDuocGiamTheoTtkt' => $this->soThueDuocGiamTheoTtkt,
            'chenhLech' => $this->chenhLech,
            'giamLo' => $this->giamLo,
            'giamKhauTru' => $this->giamKhauTru,
        ]);

        $query->andFilterWhere(['like', 'nhiemVuKiemTra', $this->nhiemVuKiemTra])
            ->andFilterWhere(['like', 'soQdkt', $this->soQdkt])
            ->andFilterWhere(['like', 'noiDungChuyenDe', $this->noiDungChuyenDe])
            ->andFilterWhere(['like', 'soQdXuLy', $this->soQdXuLy])
            ->andFilterWhere(['like', 'soKetLuan', $this->soKetLuan])
            ->andFilterWhere(['like', 'doanhNghiepCoViPham', $this->doanhNghiepCoViPham])
            ->andFilterWhere(['like', 'ghiChu1', $this->ghiChu1])
            ->andFilterWhere(['like', 'ghiChu2', $this->ghiChu2])
            ->andFilterWhere(['like', 'ghiChu3', $this->ghiChu3])
            ->andFilterWhere(['like', 'ghiChu4', $this->ghiChu4])
            ->andFilterWhere(['like', 'ghiChu5', $this->ghiChu5])
            ->andFilterWhere(['like', 'ghiChu6', $this->ghiChu6]);

        return $dataProvider;
    }
}
