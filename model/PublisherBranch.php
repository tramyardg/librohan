<?php

class PublisherBranch implements JsonSerializable
{
    private $branch_id;
    private $branch_name;
    private $publisher_id;
    private $branch_manager;
    private $phone_number;
    private $email;
    private $address;

    public function getBranchId()
    {
        return $this->branch_id;
    }

    public function setBranchId($branch_id): void
    {
        $this->branch_id = $branch_id;
    }

    public function getBranchName()
    {
        return $this->branch_name;
    }

    public function setBranchName($branch_name): void
    {
        $this->branch_name = $branch_name;
    }

    public function getPublisherId()
    {
        return $this->publisher_id;
    }

    public function setPublisherId($publisher_id): void
    {
        $this->publisher_id = $publisher_id;
    }

    public function getBranchManager()
    {
        return $this->branch_manager;
    }

    public function setBranchManager($branch_manager): void
    {
        $this->branch_manager = $branch_manager;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
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