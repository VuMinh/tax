<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Baocaochuyencongan */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\DateValidation */
$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Baocaochuyencongan',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Baocaochuyencongans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="baocaochuyencongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
