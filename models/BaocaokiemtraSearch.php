<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Baocaokiemtra;
use yii\helpers\ArrayHelper;

/**
 * BaocaokiemtraSearch represents the model behind the search form about `app\models\Baocaokiemtra`.
 */
class BaocaokiemtraSearch extends Baocaokiemtra
{

    /** @var string $truongDoan */
    public $truongDoan;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qdHtThuocKhRuiRoTrongNam', 'kiemTraTheoQuyetToanChiDao', 'ngayKyBbkt'], 'integer'],
            [['doiKiemTra', 'mst', 'soQdktId', 'soQdXuLyId', 'loaiKhuVucId', 'loaiQuyMoId', 'loaiNdktId', 'nganhNgheKinhDoanh', 'anDinh', 'ghiChu', 'hanhViViPham', 'moTaCachThucPhatHien', 'trangThaiHoSo', 'chiCucThue'], 'safe'],
            [['truyThuThueGtgt', 'truyThuThueTndn', 'truyThuTtdb', 'monBai', 'truyThuThueTncn', 'truyThuThueKhac', 'truyHoanThueGtgt', 'truyHoanThueTncn', 'truyHoanThueKhac', 'phatTronThue', 'tienHoaDon', 'phatHanhChinhKhac1020', 'phat005', 'phatChamNop', 'phatKhac', 'noDongNamTruocChuyenSang', 'noDongPhatSinhTrongNam', 'thueMienGiamTheoKeKhai', 'thueMienGiamTheoKiemTra', 'mienGiamChenhLech', 'giamKhauTru', 'thueKhongDuocHoan', 'giamLo'], 'number'],
            [['truongDoan'], 'string']
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
        $query = Baocaokiemtra::find()->orderBy(['(id)' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->soQdXuLyId == "Còn tồn") {
            $query->where(['is', 'soQdXuLyId', null]);

            return $dataProvider;
        }

        $query->joinWith('mst0');
        $query->joinWith('loaiKhuVuc');
        $query->joinWith('loaiQuyMo');
        $query->joinWith('loaiNdkt');
        $query->joinWith('soQdkt');
        $query->joinWith('soQdXuLy');
//        $query->joinWith('lichsunopsaukiemtras');

        if ($this->truongDoan) {
            $query->joinWith('soQdkt.truongDoan')->where(['like', 'truongDoan', $this->truongDoan]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'mst' => $this->mst,
//            'soQdktId' => $this->soQdktId,
            'qdHtThuocKhRuiRoTrongNam' => $this->qdHtThuocKhRuiRoTrongNam,
//            'loaiKhuVucId' => $this->loaiKhuVucId,
//            'loaiQuyMoId' => $this->loaiQuyMoId,
//            'loaiNdktId' => $this->loaiNdktId,
            'kiemTraTheoQuyetToanChiDao' => $this->kiemTraTheoQuyetToanChiDao,
            'ngayKyBbkt' => $this->ngayKyBbkt,
//            'soQdXuLyId' => $this->soQdXuLyId,
            'truyThuThueGtgt' => $this->truyThuThueGtgt,
            'truyThuThueTndn' => $this->truyThuThueTndn,
            'truyThuTtdb' => $this->truyThuTtdb,
            'monBai' => $this->monBai,
            'truyThuThueTncn' => $this->truyThuThueTncn,
            'truyThuThueKhac' => $this->truyThuThueKhac,
            'truyHoanThueGtgt' => $this->truyHoanThueGtgt,
            'truyHoanThueTncn' => $this->truyHoanThueTncn,
            'truyHoanThueKhac' => $this->truyHoanThueKhac,
            'phatTronThue' => $this->phatTronThue,
            'tienHoaDon' => $this->tienHoaDon,
            'phatHanhChinhKhac1020' => $this->phatHanhChinhKhac1020,
            'phat005' => $this->phat005,
            'phatChamNop' => $this->phatChamNop,
            'phatKhac' => $this->phatKhac,
            'noDongNamTruocChuyenSang' => $this->noDongNamTruocChuyenSang,
            'noDongPhatSinhTrongNam' => $this->noDongPhatSinhTrongNam,
            'thueMienGiamTheoKeKhai' => $this->thueMienGiamTheoKeKhai,
            'thueMienGiamTheoKiemTra' => $this->thueMienGiamTheoKiemTra,
            'mienGiamChenhLech' => $this->mienGiamChenhLech,
            'giamKhauTru' => $this->giamKhauTru,
            'thueKhongDuocHoan' => $this->thueKhongDuocHoan,
            'giamLo' => $this->giamLo,
        ]);

        $query->andFilterWhere(['like', 'nganhNgheKinhDoanh', $this->nganhNgheKinhDoanh])
            ->andFilterWhere(['like', 'anDinh', $this->anDinh])
            ->andFilterWhere(['like', 'ghiChu', $this->ghiChu])
            ->andFilterWhere(['like', 'hanhViViPham', $this->hanhViViPham])
            ->andFilterWhere(['like', 'moTaCachThucPhatHien', $this->moTaCachThucPhatHien])
            ->andFilterWhere(['like', 'trangThaiHoSo', $this->trangThaiHoSo])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->doiKiemTra])
            ->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->mst])
            ->andFilterWhere(['like', 'quyetdinhxuly.soQdXuLy', $this->soQdXuLyId])
            ->andFilterWhere(['like', 'quyetdinhkiemtra.soQdKiemTra', $this->soQdktId])
            ->andFilterWhere(['like', 'loainoidungkiemtra.loaiNd', $this->loaiNdktId]);

        return $dataProvider;
    }

    public function searchMauSoMot($params, $time = false)
    {
        $time = date($time);
        echo $time;
        // Trừ đi 30 ngày
        $now = str_replace('/', '-', $time);
        $now = date('Y-m-d', strtotime($now));
        $date = strtotime(date("d-m-Y", strtotime($now)) . " -30 day");
        $date = strftime("%Y-%m-%d", $date);

        $query = Baocaokiemtra::find()
            ->joinWith('soQdkt')
            ->joinWith('soQdXuLy')
            ->where(['<', 'quyetdinhkiemtra.ngayTao', $date])
            ->andFilterWhere([
                'or',
                ['=', 'quyetdinhxuly.ngayTao', 'null'],
                ['>', 'quyetdinhxuly.ngayTao', $now],
            ]);

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
//            'mst' => $this->mst,
            'soQdktId' => $this->soQdktId,
            'qdHtThuocKhRuiRoTrongNam' => $this->qdHtThuocKhRuiRoTrongNam,
            'loaiKhuVucId' => $this->loaiKhuVucId,
            'loaiQuyMoId' => $this->loaiQuyMoId,
            'loaiNdktId' => $this->loaiNdktId,
            'kiemTraTheoQuyetToanChiDao' => $this->kiemTraTheoQuyetToanChiDao,
            'ngayKyBbkt' => $this->ngayKyBbkt,
            'soQdXuLyId' => $this->soQdXuLyId,
            'truyThuThueGtgt' => $this->truyThuThueGtgt,
            'truyThuThueTndn' => $this->truyThuThueTndn,
            'truyThuTtdb' => $this->truyThuTtdb,
            'monBai' => $this->monBai,
            'truyThuThueTncn' => $this->truyThuThueTncn,
            'truyThuThueKhac' => $this->truyThuThueKhac,
            'truyHoanThueGtgt' => $this->truyHoanThueGtgt,
            'truyHoanThueTncn' => $this->truyHoanThueTncn,
            'truyHoanThueKhac' => $this->truyHoanThueKhac,
            'phatTronThue' => $this->phatTronThue,
            'tienHoaDon' => $this->tienHoaDon,
            'phatHanhChinhKhac1020' => $this->phatHanhChinhKhac1020,
            'phat005' => $this->phat005,
            'phatChamNop' => $this->phatChamNop,
            'phatKhac' => $this->phatKhac,
            'noDongNamTruocChuyenSang' => $this->noDongNamTruocChuyenSang,
            'noDongPhatSinhTrongNam' => $this->noDongPhatSinhTrongNam,
            'thueMienGiamTheoKeKhai' => $this->thueMienGiamTheoKeKhai,
            'thueMienGiamTheoKiemTra' => $this->thueMienGiamTheoKiemTra,
            'mienGiamChenhLech' => $this->mienGiamChenhLech,
            'giamKhauTru' => $this->giamKhauTru,
            'thueKhongDuocHoan' => $this->thueKhongDuocHoan,
            'giamLo' => $this->giamLo,
        ]);

        $query->andFilterWhere(['like', 'doiKiemTra', $this->doiKiemTra])
            ->andFilterWhere(['like', 'nganhNgheKinhDoanh', $this->nganhNgheKinhDoanh])
            ->andFilterWhere(['like', 'anDinh', $this->anDinh])
            ->andFilterWhere(['like', 'ghiChu', $this->ghiChu])
            ->andFilterWhere(['like', 'hanhViViPham', $this->hanhViViPham])
            ->andFilterWhere(['like', 'moTaCachThucPhatHien', $this->moTaCachThucPhatHien])
            ->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->mst])
            ->andFilterWhere(['like', 'trangThaiHoSo', $this->trangThaiHoSo])
            ->andFilterWhere(['like', 'chiCucThue', $this->chiCucThue]);;

        return $dataProvider;
    }
}
