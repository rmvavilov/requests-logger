<?php

namespace App\Helpers;

use Carbon\Carbon;

class Logger
{
    const REAL_IMAGE_PATH = 'img/transparent.gif';

    protected ?string $userId = null;
    protected string $userAgentName = '';
    protected string $ip = '';
    protected array $headers = [];
    protected Carbon $created_at;

    //region [GETTERS/SETTERS]

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param string|null $userId
     */
    public function setUserId(?string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string|null
     */
    public function getUserAgentName(): ?string
    {
        return $this->userAgentName;
    }

    /**
     * @param string|null $userAgentName
     */
    public function setUserAgentName(?string $userAgentName): void
    {
        $this->userAgentName = $userAgentName;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string|null $ip
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return array|null[]|\null[][]|string[]|\string[][]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array|null[]|\null[][]|string[]|\string[][] $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return Carbon|\Illuminate\Support\Carbon
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param Carbon|\Illuminate\Support\Carbon $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    //endregion [GETTERS/SETTERS]

    public function __construct()
    {
        $this->setUserId(request()->get('userId'));
        $this->setUserAgentName(request()->userAgent());
        $this->setIp(request()->ip());
        $this->setHeaders(request()->headers->all());
        $this->setCreatedAt(now());
    }
}
