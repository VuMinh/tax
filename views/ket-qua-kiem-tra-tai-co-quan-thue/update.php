<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ketquakiemtrataicoquanthue */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\Nguoinopthue */

$this->title = Yii::t('app','Cập nhật Kiểm tra tại cơ quan thuế: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ketquakiemtrataicoquanthues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ketquakiemtrataicoquanthue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'datevalidation' => $datevalidation
    ]) ?>

</div>