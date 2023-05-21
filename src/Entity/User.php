<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User extends BaseEntity implements UserInterface
{
    /**
     * User UUID
     *
     * @var string|null
     */
    private ?string $id;

    /**
     * Unique identifier for this user or bot
     *
     * @var int|null
     */
    private ?int $tg_id;

    /**
     * User's or bot's first name
     *
     * @var string
     */
    private string $first_name;

    /**
     * User's or bot's last name
     *
     * @var string
     */
    private string $last_name;

    /**
     * User's or bot's username
     *
     * @var string
     */
    private string $username;

    /**
     * True, if this user is a bot
     *
     * @var bool
     */
    private bool $is_bot;

    /**
     * IETF language tag of the user's language
     *
     * @var string
     */
    private string $language_code;

    private string|null $created_at;

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return 'sdsdd';
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    public function eraseCredentials()
    {
    }

    /**
     * Get user UUID
     *
     * @return  string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user UUID
     *
     * @param  string|null  $id  User UUID
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get iETF language tag of the user's language
     *
     * @return  string
     */
    public function getLanguageCode()
    {
        return $this->language_code;
    }

    /**
     * Set iETF language tag of the user's language
     *
     * @param  string  $language_code  IETF language tag of the user's language
     *
     * @return  self
     */
    public function setLanguageCode(string $language_code)
    {
        $this->language_code = $language_code;

        return $this;
    }

    /**
     * Get unique identifier for this user or bot
     *
     * @return  int|null
     */
    public function getTgId()
    {
        return $this->tg_id;
    }

    /**
     * Set unique identifier for this user or bot
     *
     * @param  int|null  $tg_id  Unique identifier for this user or bot
     *
     * @return  self
     */
    public function setTgId($tg_id)
    {
        $this->tg_id = $tg_id;

        return $this;
    }

    /**
     * Get user's or bot's first name
     *
     * @return  string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set user's or bot's first name
     *
     * @param  string  $first_name  User's or bot's first name
     *
     * @return  self
     */
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get true, if this user is a bot
     *
     * @return  bool
     */
    public function getIsBot()
    {
        return $this->is_bot;
    }

    /**
     * Set true, if this user is a bot
     *
     * @param  bool  $is_bot  True, if this user is a bot
     *
     * @return  self
     */
    public function setIsBot(bool $is_bot)
    {
        $this->is_bot = $is_bot;

        return $this;
    }

    /**
     * Get user's or bot's last name
     *
     * @return  string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set user's or bot's last name
     *
     * @param  string  $last_name  User's or bot's last name
     *
     * @return  self
     */
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get user's or bot's username
     *
     * @param  string  $username  User's or bot's username
     *
     * @return  self
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set user's or bot's username
     *
     * @param  string  $username  User's or bot's username
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}
