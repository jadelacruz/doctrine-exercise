<?php

namespace App\Traits;

use App\Constants\AppConstant;
use Illuminate\Support\Carbon;

trait TimestampTrait
{
    /**
     * @param string $format
     * 
     * @return string
     */
    public function getCreatedAt(string $format = AppConstant::DATE_FORMAT): string
    {
        return Carbon::parse($this->timestamp->createdAt)
                ->format($format);
    }

    /**
     * @param string $format
     * 
     * @return string
     */
    public function getUpdatedAt(string $format = AppConstant::DATE_FORMAT): string
    {
        return Carbon::parse($this->timestamp->createdAt)
                ->format($format);
    }

    /**
     * @param string $format
     * 
     * @return string
     */
    public function getDeletedAt(string $format = AppConstant::DATE_FORMAT): string
    {
        return Carbon::parse($this->timestamp->createdAt)
                ->format($format);
    }
}