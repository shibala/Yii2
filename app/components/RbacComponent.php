<?php
/**
 * Created by PhpStorm.
 */

namespace app\components;


use app\rules\ViewActivityOwnerRule;
use yii\base\Component;

class RbacComponent extends Component
{
    public function getAuthManager()
    {
        return \Yii::$app->authManager;
    }

    public function generateRbacRules()
    {
        $authManager = $this->getAuthManager();

        $authManager->removeAll();

        $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');

        $authManager->add($admin);
        $authManager->add($user);

        $viewOwnerRule = new ViewActivityOwnerRule();
        $authManager->add($viewOwnerRule);


        $createActivity = $authManager->createPermission('createActivity');
        $createActivity->description = 'Создание активности';

        $viewActivity = $authManager->createPermission('viewActivity');
        $viewActivity->description = 'Просмотр активности';
        $viewActivity->ruleName = $viewOwnerRule->name;

        $viewEditAll = $authManager->createPermission('viewEditAll');
        $viewEditAll->description = 'Просмотр и редактирование всех активностей';

        $authManager->add($createActivity);
        $authManager->add($viewActivity);
        $authManager->add($viewEditAll);

        $authManager->addChild($user, $createActivity);
        $authManager->addChild($user, $viewActivity);
        $authManager->addChild($admin, $user);
        $authManager->addChild($admin, $viewEditAll);

        $authManager->assign($user, 3);
        $authManager->assign($admin, 1);
    }

    public function addRole($id)
    {
        $authManager = $this->getAuthManager();
        $user = $authManager->createRole('user');
        $authManager->assign($user, $id);
    }

    public function canCreateActivity()
    {
        return \Yii::$app->user->can('createActivity');
    }

    public function canViewEditAll()
    {
        return \Yii::$app->user->can('viewEditAll');
    }

    public function canViewActivity($activity):bool
    {
        return \Yii::$app->user->can('viewActivity', ['activity' => $activity]);
    }
}