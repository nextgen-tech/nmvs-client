<?php
declare(strict_types=1);

namespace NGT\NMVS;

class Certificate
{
    /**
     * The path of the certificate.
     *
     * @var  string|null
     */
    private $certificatePath;

    /**
     * The path of the key certificate.
     *
     * @var  string|null
     */
    private $keyPath;

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

    public function setCertificatePath(string $certificatePath): self
    {
        $this->certificatePath = $certificatePath;

        return $this;
    }

    public function setKeyPath(string $keyPath): self
    {
        $this->keyPath = $keyPath;

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

    public function getCertificatePath(): ?string
    {
        return $this->certificatePath;
    }

    public function getKeyPath(): ?string
    {
        return $this->keyPath;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function hasKeyPath(): bool
    {
        return $this->keyPath !== null;
    }

    /**
     * Convert certificate options to CURL format.
     *
     * @return  array<int, string>
     */
    public function toCurlOptions()
    {
        $options = [
            CURLOPT_SSLCERTTYPE   => $this->getType(),
            CURLOPT_SSLCERT       => $this->getCertificatePath(),
            CURLOPT_SSLCERTPASSWD => $this->getPassword(),
        ];

        if ($this->hasKeyPath()) {
            $options[CURLOPT_SSLKEY] = $this->getKeyPath();
        }

        return array_filter($options);
    }
}
