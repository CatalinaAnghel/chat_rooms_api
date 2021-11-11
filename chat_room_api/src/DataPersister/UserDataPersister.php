<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataPersister implements DataPersisterInterface, ContextAwareDataPersisterInterface
{
    private $userPasswordHasher;
    private $decoratedDataPersister;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, DataPersisterInterface $decoratedDataPersister)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->decoratedDataPersister = $decoratedDataPersister;
    }

    /**
     * The persister system is similar with the voter system.
     * So multiple persister can exist and the appropriate one is selected using this method.
     *
     * @param array $context
     * @param $data - the data that is being persisted
     * @return bool if the persister supports this type of data
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /**
     * @param $data User
     * @param array $context
     * @return object|void
     */
    public function persist($data, array $context = [])
    {
        if(!empty($context['collection_operation_name']) && $context['collection_operation_name'] == 'post'){
            $data->setRoles();
        }
        if ($data->getPlainPassword()) {
            // hash the plain password
            $data->setPassword(
                $this->userPasswordHasher->hashPassword($data, $data->getPlainPassword())
            );

            // erase the credentials that are temporarily stored
            $data->eraseCredentials();
        }
        $this->decoratedDataPersister->persist($data);
    }

    public function remove($data, array $context = [])
    {
        $this->decoratedDataPersister->remove($data);
    }
}