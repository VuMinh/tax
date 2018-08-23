<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lydoxulycham */
/* @var $bckt app\models\Lydoxulycham */
$this->title = Yii::t('app', 'Create Lydoxulycham');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lydoxulychams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lydoxulycham-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bckt' => $bckt
    ]) ?>

</div>
