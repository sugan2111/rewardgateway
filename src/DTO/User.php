<?php

namespace App\DTO;

class User
{
    protected $uuid;
    protected $name;
    protected $company;
    protected $bio;
    protected $title;
    protected $avatar;

    public function __construct(array $user)
    {
        $this->uuid = $user['uuid'];
        $this->name = $user['name'];
        $this->company = $user['company'];
        $this->bio = $user['bio'];
        $this->title = $user['title'];
        $this->avatar = $user['avatar'];
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

}