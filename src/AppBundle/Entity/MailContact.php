<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MailContact
 * @ORM\Entity()
 * @package AppBundle\Entity
 */
class MailContact
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $message;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return MailContact
     */
    public function setName(string $name): MailContact
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return MailContact
     */
    public function setEmail(string $email): MailContact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        if (empty($this->message)) {
            $this->message = "";
        }

        return $this->message;
    }

    /**
     * @param string $message
     * @return MailContact
     */
    public function setMessage(string $message): MailContact
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return MailContact
     */
    public function setUserId(int $userId): MailContact
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return sprintf('%s <%s>', $this->getName(), $this->getEmail());
    }
}
