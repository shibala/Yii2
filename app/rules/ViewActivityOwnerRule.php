<?php
/**
 * Created by PhpStorm.
 */
namespace app\rules;

use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;
use yii\web\HttpException;

class ViewActivityOwnerRule extends Rule
{
    public $name = 'viewActivityRule';

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $activity = ArrayHelper::getValue($params, 'activity');

        if (!$activity) {
            throw new \Exception('Нет параметра activity');
        }

        return $activity->user_id == $user;
    }
}