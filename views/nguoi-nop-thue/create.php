<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nguoinopthue */

$this->title = Yii::t('app', 'Create Nguoinopthue');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nguoinopthues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nguoinopthue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->session->hasFlash('create')):?>
        <div class="alert alert-info">
            <?php echo Yii::$app->session->getFlash('create'); ?>
        </div>
    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
