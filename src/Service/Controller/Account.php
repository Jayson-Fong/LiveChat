<?php

namespace Service\Controller;

use Exception;
use Service\Entity\Password;
use Service\Entity\User;
use Service\Response;

class Account extends Controller
{

    /**
     * @throws Exception
     */
    public function actionIndex(): Response
    {
        $visitor = $this->app->visitor();
        if ($visitor->user_id)
        {
            return $this->actionManage();
        }

        return $this->app->response('login', $visitor->getData());
    }

    public function actionRegister(): Response
    {
        $visitor = $this->app->visitor();
        if ($visitor->user_id)
        {
            return $this->actionManage();
        }
        return $this->app->response('register');
    }

    public function actionRegisterpost(): Response
    {
        $visitor = $this->app->visitor();
        if ($visitor->user_id)
        {
            return $this->actionManage();
        }

        $visitor->first_name = $_POST['first_name'];
        $visitor->last_name = $_POST['last_name'];
        $visitor->display_name = $_POST['first_name'] . ' ' . $_POST['last_name'];
        $visitor->email = $_POST['email'];
        $visitor->save();

        $password = $this->app->em()->create(Password::class);
        $password->user_id = $visitor->user_id;
        $password->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password->save();

        return $this->actionIndex();
    }

    public function actionPost(): Response
    {
        $user = $this->app->db()->fetchOne('user', '*', ['email' => $_POST['email']]);
        if (!empty($user) && $user['user_id'])
        {
            $password = $this->app->db()->fetchEntity(Password::class, $user['user_id']);
            if (password_verify($_POST['password'], $password->password_hash))
            {
                setcookie('user_id', $user['user_id']);
                return $this->actionManage();
            }
        }

        return $this->actionIndex();
    }

    /**
     * @throws Exception
     */
    public function actionManage(): Response
    {
        $visitor = $this->app->visitor();
        if (!$visitor->user_id)
        {
            return $this->actionIndex();
        }

        return $this->app->response('manage_account', ['visitor' => $visitor->getData()]);
    }

    public function actionLogout(): Response
    {
        setcookie('user_id', 0);
        return $this->actionIndex();
    }

}