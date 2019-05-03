<?php


namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminRegistrationCommand extends Command
{
    
    protected static $defaultName = 'piazza-umarell:admin:registration';
    
    /**
     * @var EntityManagerInterface $_entityManager;
     */
    protected $_entityManager;
    
    /**
     * @var UserPasswordEncoderInterface $_passwordEncoder
     */
    protected $_passwordEncoder;
    
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct(self::$defaultName);
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $encoder;
    }
    
    public function configure()
    {
        $this
            ->setDescription("Creates an admin user.")
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $asker = $this->getHelper("question");
        $output->writeln("Benvenuto nella procedura di creazione admin.");
        $output->writeln("Prego, inserisci i dati necessari.\n\n");
        $continue = false;
    
        $usernameQuestion = new Question("Nome utente: ");
        $passwordQuestion = new Question("Password: ");
        $confirmationQuestion = new ConfirmationQuestion("Confermi di voler creare questo utente? (Y/n)", true);
        $continueQuestion = new ConfirmationQuestion("Vuoi creare un altro utente? (y/N)", false);
        
        
        do {
            $username = $asker->ask($input, $output, $usernameQuestion);
            $password = $asker->ask($input, $output, $passwordQuestion);
            $output->writeln("Dati inseriti:\n\tUsername:$username\n\tPassword:$password\n\n");
            $confirmation = $asker->ask($input, $output, $confirmationQuestion);
            
            if($confirmation) {
                $user = new User();
                $user->setUsername($username);
                $user->setPassword(
                    $this->_passwordEncoder->encodePassword($user, $password)
                );
                $this->_entityManager->persist($user);
                $this->_entityManager->flush();
                $output->writeln("Utente $username creato con id {$user->getId()}");
            }
            $continue = $asker->ask($input, $output, $continueQuestion);
        } while($continue);
    }
}