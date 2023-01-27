<?php
    declare(strict_types=1);

    namespace app\modules\admin;

    use app\repository\BrandRepository;
    use app\repository\UserRepository;
    use Nette\Application\UI\Presenter;


    /**
     * Class BasePresenter
     * @package App\Modules\Admin
     */
    abstract class BaseAdminPresenter extends Presenter
    {
        /** @var BrandRepository @inject */
        public BrandRepository $brandRepository;

        /** @var UserRepository @inject */
        public UserRepository $userRepository;

        protected const DEFAULT_LIMIT = 10;

        protected function startup()
        {
            parent::startup();
            if (!$this->getUser()->isLoggedIn()) {
                $this->redirect('Sign:default');
            }
        }
    }