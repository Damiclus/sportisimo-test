<?php

    namespace app\repository;

    use Nette\Database\Context;
    use Nette\Database\Table\Selection;


    /**
     * Class BaseRepository
     * @package app\repository
     */
    abstract class BaseRepository
    {
        /** @var Context */
        protected Context $db;

        protected const TABLE_USERS = "sp_users";
        protected const TABLE_RIGHTS = "sp_rights";
        protected const TABLE_USERS_RIGHTS = "sp_users_rights";
        protected const TABLE_BRANDS = "sp_brands";

        /**
         * BaseRepository constructor.
         * @param Context $db
         */
        public function __construct(Context $db)
        {
            $this->db = $db;
        }
    }