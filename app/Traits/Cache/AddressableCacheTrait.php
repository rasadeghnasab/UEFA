<?php

namespace App\Traits\Cache;

use Illuminate\Support\Facades\Redis;

trait AddressableCacheTrait
{
    public function clearCache()
    {
        $cache_key = strtolower(class_basename($this)) . ':' . $this->id .':addresses';
        Redis::del($cache_key);
    }
}
