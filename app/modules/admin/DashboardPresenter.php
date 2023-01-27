<?php
    declare(strict_types=1);

    namespace app\modules\admin;

    use Nette\Application\UI\Form;

    /**
     * Class DashboardPresenter
     * @package app\modules\admin
     */
    final class DashboardPresenter extends BaseAdminPresenter
    {
        public function renderDefault(): void
        {
           $this->template->countUsers = $this->userRepository->getUsersCount();
           $this->template->countBrands = $this->brandRepository->getBrandsCount();
        }
    }
