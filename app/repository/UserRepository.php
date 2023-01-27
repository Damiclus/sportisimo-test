<?php

    namespace app\repository;

    use app\entities\User;

    class UserRepository extends BaseRepository
    {
        public const COLUMN_ID = 'user_id';
        public const COLUMN_EMAIL = 'user_email';

        /**
         * @return array
         */
        public function getUsers(int $limit = null, int $offset = null, string $sortingKey = "1", string $sorting = "ASC"): array
        {
            $users = [];

            $data = $this->db->table(self::TABLE_USERS)
                ->limit($limit, $offset)
                ->order($sortingKey." ".$sorting)
                ->fetchAssoc(self::COLUMN_ID);

            foreach ($data as $user) {
                $users[] = new User(
                    $user['user_id'],
                    $user['user_name'],
                    $user['user_email']
                );
            }

            return $users;
        }

        public function getUsersCount(): int
        {
            return $this->db->table(self::TABLE_USERS)->count();
        }

        /**
         * @param $id
         * @return User|null
         */
        public function getUser($id): ?User
        {
            $data = $this->db->table(self::TABLE_USERS)
                ->where(self::COLUMN_ID, $id)
                ->fetch()
                ->toArray();


            return $data ? new User($data['user_id'], $data['user_name'], $data['user_email']) : null;
        }

        /**
         * @param $email
         * @param $password
         * @return User|null
         */
        public function verifyUser($email, $password): ?User
        {
            $data = $this->db->table(self::TABLE_USERS)
                ->where(self::COLUMN_EMAIL, $email)->fetch();

            if($data) {
                $data = $data->toArray();
                if (password_verify($password, $data['user_password'])) {
                    return new User($data['user_id'], $data['user_name'], $data['user_email']);
                }
            }

            return null;
        }

        /**
         * @param string $name
         * @param string $email
         * @param string $password
         * @return void
         */
        public function putUser(string $name, string $email, string $password): void
        {
            $this->db->table(self::TABLE_USERS)->insert(
                [
                    "user_name" => $name,
                    "user_email" => $email,
                    "user_password" => $password
                ]
            );
        }

        /**
         * @param int $id
         * @param array $diff
         * @return void
         */
        public function updateUser(int $id, array $diff): void
        {
            $this->db->table(self::TABLE_USERS)
                ->where(self::COLUMN_ID, $id)
                ->update($diff);
        }

        /**
         * @param int $id
         * @return void
         */
        public function removeUser(int $id): void
        {
            $this->db->table(self::TABLE_USERS)
                ->where(self::COLUMN_ID, $id)
                ->delete();
        }
    }
