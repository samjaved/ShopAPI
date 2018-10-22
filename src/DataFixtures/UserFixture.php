<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21/10/2018
 * Time: 2:57 AM
 */

namespace App\DataFixtures;


use App\Entity\BackendUser;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user1 = $this->createUser($manager, 'sammar.javed', 'password');
    }
    private function createUser(
        ObjectManager $manager,
        string $username,
        string $password
    ): BackendUser {
        $user = new BackendUser($username);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
        $manager->persist($user);
        $manager->flush();
        return $user;
    }
}