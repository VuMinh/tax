<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ketquakiemtrataicoquanthue;

/**
 * KetquakiemtrataicoquanthueSearch represents the model behind the search form about `app\models\Ketquakiemtrataicoquanthue`.
 */
class KetquakiemtrataicoquanthueSearch extends Ketquakiemtrataicoquanthue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trangThaiHoSoId', 'nguoiNopThueId'], 'integer'],
            [['phongBan', 'ngayTao', 'ngayCapNhat', 'anDinh', 'ghiChu1', 'ghiChu2', 'ghiChu3'], 'safe'],
            [['tongThueDieuChinhTang', 'tongThueDieuChinhGiam', 'giamKhauTru', 'giamLo', 'tienDuocMineTang', 'tienDuocMienGiam'], 'number'],
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
        $query = Ketquakiemtrataicoquanthue::find();

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

        $query->joinWith('nguoiNopThue');
        $query->joinWith('trangThaiHoSo');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngayTao' => $this->ngayTao,
            'trangThaiHoSoId' => $this->trangThaiHoSoId,
            'ngayCapNhat' => $this->ngayCapNhat,
            'tongThueDieuChinhTang' => $this->tongThueDieuChinhTang,
            'tongThueDieuChinhGiam' => $this->tongThueDieuChinhGiam,
            'giamKhauTru' => $this->giamKhauTru,
            'giamLo' => $this->giamLo,
            'tienDuocMineTang' => $this->tienDuocMineTang,
            'tienDuocMienGiam' => $this->tienDuocMienGiam,
//            'nguoiNopThueId' => $this->nguoiNopThueId,
        ]);

        $query->andFilterWhere(['like', 'phongBan', $this->phongBan])
            ->andFilterWhere(['like', 'anDinh', $this->anDinh])
            ->andFilterWhere(['like', 'nguoinopthue.maSoThue', $this->nguoiNopThueId])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->ghiChu2])
            ->andFilterWhere(['like', 'trangthaihoso.trangThaiHs', $this->ghiChu3]);

        return $dataProvider;
    }
}
