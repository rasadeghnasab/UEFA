<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match
    | response messages to api calls.
    |
    */
    'successfulSent' => 'با موفقیت ارسال شد.',

    'unsuccessfulSent' => 'ارسال ناموفق بود.',

    'methodNotAvailable' => 'متد هم اکنون در دسترس نیست',

    'internalServerError' => 'خطایی در سرور رخ داده است، لطفا دوباره امتحان نمایید',

    'TheGivenDataWasInvalid' => 'اطلاعات وارد شده صحیح نمی باشد.',

    'belongs' => ':child متعلق به :parent نمی باشد.',

    'owns' => [
        'failed' => ':owns متعلق به این :owner نیست.',
        'success' => ':owns متعلق به این :owner است.',
    ],

    'crud' => [
        'prevented' => [
            'in-use' => ':model مورد نظر در حال استفاده می باشد، امکان ویرایش یا حذف آن وجود ندارد.',
            'has-active-child' =>
            'در حال حاضر امکان تغییر بر روی :model مورد نظر وجود ندارد. حداقل یک :child فعال به این :model متصل است.'
        ],
        'success' => [
            'store' => ':model با موفقیت ایجاد گردید.',
            'update' => ':model با موفقیت به روز رسانی شد.',
            'delete' => ':model با موفقیت حذف گردید.',
            'restore' => ':model با موفقیت با بازگردانی شد.',
            'archive' => ':model با موفقیت آرشیو شد.',
            'verify' => ':model با موفقیت تایید شد.',
            'retrieve' => ':model با موفقیت بازیابی شد.',
            'confirm' => ':model با موفقیت تایید شد.'
        ],
        'fail' => [
            'store' => 'ایجاد :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'update' => 'به روز رسانی :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'delete' => 'حذف :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'restore' => 'بازگردانی :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'archive' => 'آرشیو :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'verify' => 'تایید :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'retrieve' => 'بازیابی :model ناموفق بود! لطفا دوباره تلاش نمایید.',
            'confirm' => 'تایید :model ناموفق بود! لطفا دوباره تلاش نمایید.'
        ],
    ],

    'social' => [
        'networks' => [
            'addOrUpdate' => [
                'successful' => 'شبکه اجتماعی با موفقیت به روز رسانی شد.',
                'fail' => 'به روز رسانی شبکه اجتماعی ناموفق بود، لطفا دوباره امتحان نمایید.'
            ],
            'destroy' => [
                'successful' => 'شبکه اجتماعی با موفقیت حذف شد.',
                'fail' => 'حذف شبکه اجتماعی ناموفق بود، لطفا دوباره امتحان نمایید.'
            ],
        ]
    ],

    'api-call' => [
        'sms' => [
            'failed' => 'ارسال پیام ناموفق بود.'
        ]
    ]
];
