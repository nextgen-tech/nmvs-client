<?php
declare(strict_types=1);

namespace NGT\NMVS;

class Credentials
{
    /**
     * The value of client ID.
     *
     * @var  string|null
     */
    private $clientId;

    /**
     * The value of user ID.
     *
     * @var  string|null
     */
    private $userId;

    /**
     * The value of user password.
     *
     * @var  string|null
     */
    private $password;

    /**
     * The value of sub-user ID.
     *
     * @var  string|null
     */
    private $subUserId;

    public function __construct(
        string $clientId = null,
        string $userId = null,
        string $password = null,
        string $subUserId = null
    ) {
        $this->setClientId($clientId);
        $this->setUserId($userId);
        $this->setPassword($password);
        $this->setSubUserId($subUserId);
    }

    public function setClientId(?string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function setUserId(?string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setSubUserId(?string $subUserId): self
    {
        $this->subUserId = $subUserId;

        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getSubUserId(): ?string
    {
        return $this->subUserId;
    }
}
