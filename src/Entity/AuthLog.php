<?php

namespace App\Entity;

class AuthLog extends BaseEntity
{
    const ACTION_LOGIN = 'login';
    const ACTION_REGISTER = 'register';

    /**
     * User UUID
     *
     * @var string|null
     */
    private ?string $id;

    /**
     * Reference to users table
     *
     * @var string
     */
    private ?string $user_id;

    /**
     * Action type
     *
     * @var string
     */
    private string $action;

    private string|null $created_at;

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

    /**
     * Get action type
     *
     * @return  string
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set action type
     *
     * @param  string  $action  Action type
     *
     * @return  self
     */ 
    public function setAction(string $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get reference to users table
     *
     * @return  string
     */ 
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set reference to users table
     *
     * @param  string  $user_id  Reference to users table
     *
     * @return  self
     */ 
    public function setUserId(string $user_id)
    {
        $this->user_id = $user_id;

        return $this;
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
}
