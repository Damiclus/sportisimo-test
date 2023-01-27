<?php

    namespace app\repository;

    use app\entities\Brand;
    use app\entities\User;
    use utils\Strings;

    class BrandRepository extends BaseRepository
    {

        public const FILTER_NAME = "brand_name LIKE ?";
        public const COLUMN_CREATED = "brand_created";
        public const COLUMN_CODE = "brand_code";
        public const COLUMN_ID = "brand_id";

        /**
         * @param array $conds
         * @param int|null $limit
         * @param int|null $offset
         * @param array $sorting
         * @return array
         */
        public function getBrands(int $limit = null, int $offset = null, string $sortingKey = "1", string $sorting = "ASC"): array
        {
            $brands = [];

            $query = "
                SELECT b.*,
                       u.user_id as created_user_id,
                       u.user_name as created_user_name,
                       u.user_email as created_user_email,
                       ue.user_id as edited_user_id,
                       ue.user_name as edited_user_name,
                       ue.user_email as edited_user_email
                    FROM sp_brands b
                    JOIN sp_users u ON b.brand_created_by = u.user_id
                    LEFT JOIN sp_users ue ON b.brand_edited_by = ue.user_id
                    ORDER BY {$sortingKey} {$sorting}
                    LIMIT ? OFFSET ?
            ";

            $data = $this->db->query($query, $limit, $offset)->fetchAssoc(self::COLUMN_ID);
            foreach ($data as $item) {
                $brands[] = $this->prepareBrandEntity($item);
            }

            return $brands;
        }

        public function getBrandsCount(): int
        {
            return $this->db->table(self::TABLE_BRANDS)->count();
        }

        /**
         * @param $id
         * @return Brand|null
         */
        public function getBrand($id): ?Brand
        {
            $data = $this->db->query("
                SELECT b.*,
                   u.user_id as created_user_id,
                   u.user_name as created_user_name,
                   u.user_email as created_user_email,
                   ue.user_id as edited_user_id,
                   ue.user_name as edited_user_name,
                   ue.user_email as edited_user_email
                FROM sp_brands b
                JOIN sp_users u ON b.brand_created_by = u.user_id
                LEFT JOIN sp_users ue ON b.brand_edited_by = ue.user_id
                WHERE b.brand_id = ?
            ", $id)->fetchAssoc(self::COLUMN_ID);

            return $data ? $this->prepareBrandEntity(array_values($data)[0]) : null;
        }

        /**
         * @param Brand $brand
         * @return void
         */
        public function putBrand(Brand $brand): void
        {
            $this->db->table(self::TABLE_BRANDS)->insert(
                [
                    "brand_name" => $brand->name,
                    "brand_code" => Strings::webalize($brand->name),
                    "brand_created" => $brand->created,
                    "brand_created_by" => $brand->createdBy->id
                ]
            );
        }

        /**
         * @param int $id
         * @param array $diff
         * @return void
         */
        public function updateBrand(int $id, array $diff): void
        {
            $this->db->table(self::TABLE_BRANDS)
                ->where(self::COLUMN_ID, $id)
                ->update($diff);
        }

        /**
         * @param int $id
         * @return void
         */
        public function removeBrand(int $id): void
        {
            $this->db->table(self::TABLE_BRANDS)
                ->where(self::COLUMN_ID, $id)
                ->delete();
        }

        /**
         * @param array $item
         * @return Brand
         */
        private function prepareBrandEntity(array $item): Brand
        {
            $item['brand_created_by'] = new User($item['created_user_id'], $item['created_user_name'], $item['created_user_email']);
            unset($item['created_user_id'], $item['created_user_name'], $item['created_user_email']);
            if(!$item['brand_edited_by']) {
                unset($item['brand_edited'], $item['brand_edited_by']);
            } else {
                $item['brand_edited_by'] = new User($item['edited_user_id'], $item['edited_user_name'], $item['edited_user_email']);
                unset($item['edited_user_id'], $item['edited_user_name'], $item['edited_user_email']);
            }

            return new Brand($item);
        }
    }
;