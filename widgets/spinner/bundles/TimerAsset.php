<?php
/**
 * @link http://www.digitaldeals.cz/
 * @copyright Copyright (c) 2016 Digital Deals s.r.o.
 * @license http://www.digitaldeals.cz/license/
 */

namespace dlds\components\widgets\spinner\bundles;

use yii\web\AssetBundle;

/**
 * @author Jiri Svoboda <jiri.svobodao@dlds.cz>
 * @package spinner
 */
class TimerAsset extends AssetBundle {

    public $sourcePath = '@bower/load-awesome/css';

    public function init()
    {
        if (YII_DEBUG)
        {
            $this->css[] = 'timer.css';
        }
        else
        {
            $this->css[] = 'timer.min.css';
        }

        return parent::init();
    }
}