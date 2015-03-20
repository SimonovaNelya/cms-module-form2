<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 18.03.2015
 */
namespace skeeks\modules\cms\form\widgets;
use skeeks\modules\cms\form\models\Form;

/**
 * Class ActiveForm
 * @package skeeks\modules\cms\form\widgets
 */
class ActiveForm extends \skeeks\cms\base\widgets\ActiveForm
{
    /**
     * @var Form
     */
    public $modelForm;

    public function __construct($config = [])
    {
        $this->validationUrl                = \skeeks\cms\helpers\UrlHelper::construct('form/backend/validate')->toString();
        $this->action                       = \skeeks\cms\helpers\UrlHelper::construct('form/backend/submit')->toString();

        $this->enableAjaxValidation         = true;

        parent::__construct($config);
    }

    public function init()
    {
        parent::init();

        echo \yii\helpers\Html::hiddenInput(Form::FROM_PARAM_ID_NAME, $this->modelForm->id);
    }


    public function run()
    {
        parent::run();

        $this->view->registerJs(<<<JS

        $('#{$this->id}').on('beforeSubmit', function (event, attribute, message) {
            return false;
        });

        $('#{$this->id}').on('afterValidate', function (event, attribute, message) {

            var Jform = $(this);
            var ajax = sx.ajax.preparePostQuery($(this).attr('action'), $(this).serialize());

            new sx.classes.AjaxHandlerBlocker(ajax, {
                'wrapper': '#' + $(this).attr('id')
            });
            //new sx.classes.AjaxHandlerNoLoader(ajax); //отключение глобального загрузчика
            new sx.classes.AjaxHandlerNotifyErrors(ajax, {
                'error': "Не удалось отправить форму",
            }); //отключение глобального загрузчика

            ajax.onError(function(e, data)
                {

                })
                .onSuccess(function(e, data)
                {
                    var response = data.response;
                    if (response.success == true)
                    {
                        $('input, select, textarea', Jform).each(function(i,s)
                        {
                            if ($(this).attr('name') != '_csrf' && $(this).attr('name') != 'sx-auto-form')
                            {
                                $(this).val('');
                            }
                        });

                        sx.notify.success(response.message);
                    } else
                    {
                        sx.notify.error(response.message);
                    }

                })
                .execute();

            return false;
        });


JS
);
    }

}
