<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Danhsachhoadonvipham */
/* @var $nguoimua app\models\Danhsachhoadonvipham */
/* @var $datevalidation app\models\Danhsachhoadonvipham */
$this->title = Yii::t('app', 'Create Danhsachhoadonvipham');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Danhsachhoadonviphams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="danhsachhoadonvipham-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoimua' => $nguoimua,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
