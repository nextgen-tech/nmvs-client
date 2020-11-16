<?php
declare(strict_types=1);

namespace NGT\NMVS;

use InvalidArgumentException;

class Certificate
{
    /**
     * The path of the certificate.
     *
     * @var  string
     */
    private $path;

    /**
     * The password of the certificate.
     *
     * @var  string|null
     */
    private $password;

    /**
     * The type of the certificate.
     *
     * @var  string
     */
    private $type = 'PEM';

    public function setPath(string $path): self
    {
        $this->path = $path;

        $this->setTypeFromExtension(pathinfo($this->path, PATHINFO_EXTENSION));

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = strtoupper($type);

        return $this;
    }

    protected function setTypeFromExtension(string $extension): void
    {
        $extension = strtoupper($extension);

        if (!in_array($extension, ['PEM', 'P12'], true)) {
            throw new InvalidArgumentException();
        }

        $this->setType($extension);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get Guzzle certificate format.
     *
     * @return  array|string
     */
    public function toCert()
    {
        if ($this->password !== null) {
            return [$this->path, $this->password];
        }

        return $this->path;
    }
}
