<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cbr extends Model
{
    protected $table = 'cbr';
    protected $guarded = [];

    public function scopeGetCurrentCbr($quary)
    {
        return $quary->get();
    }

    public function createCbr(array $createCbr)
    {
        $this->truncate();
        foreach ($createCbr as $item) $this->insert($item);
    }
}