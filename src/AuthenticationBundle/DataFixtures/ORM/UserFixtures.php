<?php


namespace AuthenticationBundle\DataFixtures\ORM;


use AuthenticationBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    const USERNAME_ADMIN = 'admin';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername(static::USERNAME_ADMIN);
        $user->setEmail('admin@example.com');
        $user->setPlainPassword(static::USERNAME_ADMIN);
        $user->setStatus(1);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}