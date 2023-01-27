<?php
    declare(strict_types=1);

    namespace app\modules\front;


    use app\repository\BrandRepository;
    use Nette\Application\UI\Presenter;
    use Nette\Utils\Paginator;

    /**
     * Class HomepagePresenter
     * @package app\modules\front
     */
    class HomepagePresenter extends Presenter
    {
        /** @var BrandRepository @inject */
        public BrandRepository $brandRepository;

        private const DEFAULT_LIMIT = 10;

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
    }