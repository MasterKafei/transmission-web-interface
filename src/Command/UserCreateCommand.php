<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:user:create',
    description: 'Create a new user on this application',
)]
class UserCreateCommand extends Command
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected ?string $defaultUsername,
        protected ?string $defaultPlainPassword,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('username', null, InputOption::VALUE_OPTIONAL, 'Username of the user')
            ->addOption('plainPassword', null, InputOption::VALUE_OPTIONAL, 'Password of the user')
            ->addOption('from-env', null, InputOption::VALUE_NONE, 'Import information from env variable')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $options = [
            'username' => ['default' => $this->defaultUsername],
            'plainPassword' => ['hidden' => true, 'default' => $this->defaultPlainPassword],
        ];

        $user = new User();
        $reflection = new \ReflectionClass($user);

        foreach ($options as $optionName => $questionOptions) {
            if ($input->getOption('from-env')) {
                $value = $questionOptions['default'];
            } else if (!$value = $input->getOption($optionName)) {
                $value = $this->askQuestion($optionName, $input, $output, $questionOptions);
            }

            $reflection->getProperty($optionName)->setValue($user, $value);
        }

        $inputOutput = new SymfonyStyle($input, $output);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            $inputOutput->error($exception->getMessage());
            return Command::FAILURE;
        }

        $inputOutput->success("User with username \"{$user->getUsername()}\" successfully created !");

        return Command::SUCCESS;
    }

    protected function askQuestion(string $optionName, InputInterface $input, OutputInterface $output, array $questionOptions): string
    {
        $question = new Question("$optionName: ");
        $questionHelper = new QuestionHelper();
        $question->setHidden($questionOptions['hidden'] ?? false);
        return $questionHelper->ask($input, $output, $question);
    }
}
