<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Danhsachhoadonvipham */
/* @var $nguoimua app\models\Danhsachhoadonvipham */
/* @var $nguoiban app\models\Danhsachhoadonvipham */
/* @var $datevalidation app\models\Danhsachhoadonvipham */
$this->title = Yii::t('app', 'Cập nhật hóa đơn vi phạm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Danhsachhoadonviphams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="danhsachhoadonvipham-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoimua' => $nguoimua,
//        'nguoiban' => $nguoiban,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
