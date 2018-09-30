<?php

use yii\db\Migration;

/**
 * Class m180924_092304_init_rbac
 */
class m180924_092304_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "readSome" permission
        $readSome = $auth->createPermission('readSome');
        $readSome->description = 'Read Some posts';
        $auth->add($readSome);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        //add "registerd" role and give this role the "readSome" permission
        $registered = $auth->createRole('registered user');
        $auth->add($registered);
        $auth->addChild($registered, $readSome);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" and "registered" role
        $admin = $auth->createRole('Super Administrator');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $registered);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180924_092304_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
