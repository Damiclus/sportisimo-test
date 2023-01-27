<?php
    declare(strict_types=1);

    namespace app\modules\admin;

    use app\entities\Brand;
    use app\entities\User;
    use app\repository\BrandRepository;
    use app\repository\UserRepository;
    use Nette\Application\UI\Form;
    use Nette\Utils\DateTime;
    use Nette\Utils\Paginator;
    use utils\Strings;

    /**
     * Class DashboardPresenter
     * @package app\modules\admin
     */
    class UsersPresenter extends BaseAdminPresenter
    {
        /** @var User|null */
        private ?User $user;

        public function renderDefault(
            int $page = 1,
          int $limit = self::DEFAULT_LIMIT,
          string $sorting = UserRepository::COLUMN_ID,
          string $direction = "ASC"
        ): void
        {
            $paginator = new Paginator();

            $paginator->setItemCount($this->userRepository->getUsersCount()); // total articles count
            $paginator->setItemsPerPage($limit); // items per page
            $paginator->setPage($page); // actual page number

            $this->template->paginator = $paginator;

            $this->template->users = $this->userRepository->getUsers(
                $paginator->getLength(),
                $paginator->getOffset(),
                $sorting,
                $direction
            );
        }

        public function renderEdit(int $id = null) : void {}

        /**
         * @throws \Nette\Application\AbortException
         */
        public function actionDelete(int $id) : void
        {
            $this->userRepository->removeUser($id);
            $this->redirect("Users:default");
        }

        public function createComponentBrandForm(): Form
        {
            $id = $this->getPresenter()->getParameter('id');
            $this->user = $id ? $this->userRepository->getUser((int)$id) : null;
            $form = new Form();
            $form->addText('name', 'Name')
                ->setDefaultValue($this->user ? $this->user->name : "")
                ->setRequired();
            $form->addEmail('email', 'E-mail')
                ->setDefaultValue($this->user ? $this->user->email : "")
                ->setRequired();
            $form->addPassword('password', 'Password')
                ->setRequired(!$this->user);
            $form->addSubmit('save', 'Save');

            $form->onSuccess[] = [$this, 'sendForm'];
            return $form;
        }

        public function sendForm (Form $form) : void
        {
            $values = $form->getValues();

            $data = [];
            $data['user_name'] = $values->name;
            $data['user_email'] = $values->email;
            if($values->password) {
                $data['user_password'] = password_hash($values->password, PASSWORD_DEFAULT);
            }
            if($this->user) {
                $this->userRepository->updateUser($this->user->id, $data);
                $this->flashMessage("User {$this->user->name} was updated!");
            } else {
                $this->userRepository->putUser($data['user_name'], $data['user_email'], $data['user_password']);
                $this->flashMessage("User $values->name was created!");
            }

            $this->redirect('Users:default');
        }
    }