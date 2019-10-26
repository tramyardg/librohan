<?php

class Author implements JsonSerializable
{

    private $author_id;
    private $first_name;
    private $middle_name;
    private $last_name;
    private $bio;

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id): void
    {
        $this->author_id = $author_id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getMiddleName()
    {
        return $this->middle_name;
    }

    public function setMiddleName($middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio): void
    {
        $this->bio = $bio;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}