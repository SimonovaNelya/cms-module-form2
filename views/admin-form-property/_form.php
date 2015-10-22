<?php

use yii\helpers\Html;
use skeeks\cms\modules\admin\widgets\form\ActiveFormUseTab as ActiveForm;
use skeeks\cms\models\Tree;
use skeeks\cms\modules\admin\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model Tree */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->fieldSet('Основные настройки') ?>

    <?= $form->fieldRadioListBoolean($model, 'active') ?>
    <?= $form->fieldRadioListBoolean($model, 'is_required') ?>


<? if ($content_id = \Yii::$app->request->get('form_id')) : ?>

    <?= $form->field($model, 'form_id')->hiddenInput(['value' => $content_id])->label(false); ?>

<? else: ?>

    <?= $form->field($model, 'form_id')->label('Контент')->widget(
        \skeeks\cms\widgets\formInputs\EditedSelect::className(), [
            'items' => \yii\helpers\ArrayHelper::map(
                 \skeeks\modules\cms\form2\models\Form2Form::find()->all(),
                 "id",
                 "name"
             ),
            'controllerRoute' => 'form2/admin-form',
        ]);
    ?>

<? endif; ?>

    <?= $form->fieldSelect($model, 'component', [
        'Базовые типы'          => \Yii::$app->cms->basePropertyTypes(),
        'Пользовательские типы' => \Yii::$app->cms->userPropertyTypes(),
    ])
        ->label("Тип свойства")
        ;
    ?>
    <?= $form->field($model, 'component_settings')->label(false)->widget(
        \skeeks\cms\widgets\formInputs\componentSettings\ComponentSettingsWidget::className(),
        [
            'componentSelectId' => Html::getInputId($model, "component")
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'code')->textInput() ?>

<?= $form->fieldSetEnd(); ?>

<?= $form->fieldSet('Дополнительно') ?>
    <?= $form->field($model, 'hint')->textInput() ?>
    <?= $form->fieldInputInt($model, 'priority') ?>

    <?= $form->fieldRadioListBoolean($model, 'searchable') ?>
    <?= $form->fieldRadioListBoolean($model, 'filtrable') ?>
    <?= $form->fieldRadioListBoolean($model, 'smart_filtrable') ?>
    <?= $form->fieldRadioListBoolean($model, 'with_description') ?>
<?= $form->fieldSetEnd(); ?>


<? if (!$model->isNewRecord) : ?>
<?= $form->fieldSet('Значения для списка') ?>

    <?= \skeeks\cms\modules\admin\widgets\RelatedModelsGrid::widget([
        'label'             => "Значения для списка",
        'hint'              => "Вы можете привязать к элементу несколько свойст, и задать им значение",
        'parentModel'       => $model,
        'relation'          => [
            'property_id' => 'id'
        ],

        'sort'              => [
            'defaultOrder' =>
            [
                'priority' => SORT_ASC
            ]
        ],

        'controllerRoute'   => 'form2/admin-form-property-enum',
        'gridViewOptions'   => [
            'sortable' => true,
            'columns' => [
                'id',
                'code',
                'value',
                'priority',
                'def',
            ],
        ],
    ]); ?>

<?= $form->fieldSetEnd(); ?>
<? endif; ?>

<?= $form->buttonsCreateOrUpdate($model); ?>

<?php ActiveForm::end(); ?>




