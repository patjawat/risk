<?php

namespace risk\modules\content;

/**
 * content module definition class
 */
class Content extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'risk\modules\content\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //\Yii::$app->errorHandler->errorAction = 'content/default/error';

        // custom initialization code goes here
    }
}
