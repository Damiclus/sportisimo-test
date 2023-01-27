<?php
    declare(strict_types=1);

    namespace app\modules\admin;

    use app\entities\Brand;
    use app\entities\User;
    use app\repository\BrandRepository;
    use Nette\Application\UI\Form;
    use Nette\Utils\DateTime;
    use Nette\Utils\Paginator;
    use utils\Strings;

    /**
     * Class DashboardPresenter
     * @package app\modules\admin
     */
    class BrandsPresenter extends BaseAdminPresenter
    {
        /** @var Brand|null */
        private ?Brand $brand;

        public function renderDefault(
            int $page = 1,
            int $limit = self::DEFAULT_LIMIT,
            string $sorting = BrandRepository::COLUMN_ID,
            string $direction = "ASC"
        ): void
        {

            $paginator = new Paginator();

            $paginator->setItemCount($this->brandRepository->getBrandsCount()); // total articles count
            $paginator->setItemsPerPage($limit); // items per page
            $paginator->setPage($page); // actual page number

            $this->template->paginator = $paginator;

            $this->template->sorting = $sorting;
            $this->template->direction = $direction;
            $this->template->brands = $this->brandRepository->getBrands(
                $paginator->getLength(),
                $paginator->getOffset(),
                $sorting,
                $direction,
            );
        }

        public function renderEdit(int $id = null) : void {}

        /**
         * @throws \Nette\Application\AbortException
         */
        public function actionDelete(int $id) : void
        {
            $this->brandRepository->removeBrand($id);
            $this->redirect("Brands:default");
        }

        public function createComponentBrandForm(): Form
        {
            $id = $this->getPresenter()->getParameter('id');
            $this->brand = $id ? $this->brandRepository->getBrand((int)$id) : null;
            $form = new Form();
            $form->addText('name', 'Name')
                ->setDefaultValue($this->brand ? $this->brand->name : "")
                ->setRequired();;
            $form->addSubmit('save', 'Save');

            $form->onSuccess[] = [$this, 'sendForm'];
            return $form;
        }

        public function sendForm (Form $form) : void
        {
            $values = $form->getValues();

            $data = [];
            $data['brand_name'] = $values->name;
            $data['brand_code'] = Strings::webalize($values->name);
            if($this->brand && $values->name !== $this->brand->name) {

                $data['brand_edited'] = new DateTime();
                $data['brand_edited_by'] = $this->getUser()->getId();

                $this->brandRepository->updateBrand($this->brand->id, $data);
                $this->flashMessage("Brand {$this->brand->name} was updated!");
            } else if (!$this->brand){
                $data['brand_created'] = new DateTime();
                $data['brand_created_by'] = new User(
                    $this->getUser()->getId(),
                    $this->getUser()->getIdentity()->getData()['name'],
                    $this->getUser()->getIdentity()->getData()['email']);
                $this->brandRepository->putBrand(new Brand($data));

                $this->flashMessage("Brand $values->name was created!");
            } else {
                $this->flashMessage("Nothing to update!");
            }

            $this->redirect('Brands:default');
        }
    }