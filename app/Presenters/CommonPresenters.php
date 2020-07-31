<?php

namespace App\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

class CommonPresenters extends BasePresenter
{
    public function persianCreatedAt()
    {
        $created_at = $this->wrappedObject->created_at;

        return jdate($created_at->timestamp);
    }
}
