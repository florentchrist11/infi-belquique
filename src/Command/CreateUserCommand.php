<?php

namespace App\Command;

use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create:user';
    protected static $defaultDescription = 'Add a short description for your command';

    private EntityManagerInterface $em;

    private UserPasswordHasherInterface $passwordHasher;

    /**
     * CreateUserCommand constructor.
     * @param EntityManagerInterface $em
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
    }


    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email de connexion')
            ->addArgument('password', InputArgument::REQUIRED, 'password de connexion')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Admin options')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $newUser = new Utilisateurs();

        if ($email) {
            $newUser->setEmail($email);
            $newUser->setCreatedAt(new \DateTime());
            $newUser->setPassword($this->passwordHasher->hashPassword($newUser,$password));
            $io->success('Creation d\'un utilisateur reussi.');
        }

        if ($input->getOption('admin')) {
            $newUser->setRoles(['ROLE_ADMIN']);
            $io->success('Creation d\'un utilisateur admin reussi.');
        }
        $this->em->persist($newUser);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
