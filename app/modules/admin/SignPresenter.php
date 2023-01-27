<?php
declare(strict_types=1);

namespace app\modules\admin;

use app\repository\UserRepository;
use app\utils\BasicAuth;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Security\AuthenticationException;

/**
 * Class SignPresenter
 * @package app\modules\admin
 */
final class SignPresenter extends Presenter
{

    /** @var BasicAuth @inject */
    public BasicAuth $authenticator;

    /**
     * @param string|null $ref
     * @return void
     * @throws AbortException
     */
    public function actionOut(?string $ref = null)
    {
        $this->user->logout();
        $this->redirect("Sign:default");
    }

   public function renderDefault() {}
    public function createComponentLoginForm(): Form
    {
        $form = new Form();

        $form->addText('email', 'E-mail');
        $form->addPassword('password', 'Password');
        $form->addSubmit('login', 'Login');

        $form->onSuccess[] = function (Form $form, \stdClass $data) {
            $user = $this->getUser();
            $user->setAuthenticator($this->authenticator);
            try {
                $user->login($data->email, $data->password);
                $this->redirect('Dashboard:default');
            } catch (AuthenticationException $e) {
                $this->flashMessage($e ->getMessage());
            }
        };

        return $form;
    }
}
