<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => [
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ],
    "boolean" => "فیلد :attribute باید یکی از مقادیر 0 یا 1 باشد.",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => [
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ],
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => [
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ],
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => "فرمت :attribute صحیح نیست.",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => "وارد کردن :attribute و یا :values الزامی است.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => [
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ],
    'string' => ':attribute باید حروف باشد.',
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => "این :attribute از قبل موجود است.",
    'uploaded' => 'آپلود :attribute ناموفق بود.',
    "url" => "فرمت آدرس :attribute اشتباه است.",
    "mobile" => ":attribute وارد شما صحیح نمیباشد.",
    "invalid_word" => "مقدار وارد شده برای :attribute قابل قبول نیست.",
    "password" => '.قالب :attribute وارد شده صحیح نمی باشد',
    "current_password" => '.:attribute وارد شده صحیح نمی باشد',
    "mobile_or_email" => "نام کاربری می بایست ایمیل و یا شماره موبایل باشد.",
    "sheba" => "شماره شبا وارد شده صحیح نیست.",
    "card_match_bank" => ":attribute وارد شده متعلق به این بانک نیست.",
    "sheba_match_bank" => ":attribute وارد شده متعلق به این بانک نیست.",
    "related_field_not_found" => "وارد کردن :related_field الزامی است.",


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'purchase' => [
            'unique' => 'این خرید قبلا پرداخت شده است.'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "شماره",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "comment_content" => "محتوای نظر",
        "comment_author_email" => "ایمیل نویسنده",
        "comment_author_url" => "آدرس وب سایت نویسنده",
        "full_name" => "نام کامل",
        "pnr_reference" => "شماره رفرنس",
        "voucher" => "شماره واچر",
        "account_owner_name" => "نام صاحب حساب",
        "card_number" => "شماره کارت",
        "card" => "شماره کارت",
        "bank_card" => "شماره کارت",
        "bank_id" => "نام بانک",
        "account_number" => "شماره حساب",
        "sheba_number" => "شماره شبا",
        "sheba" => "شماره شبا",
        "refund_type_id" => "نوع استرداد",
        "cbTerms" => "شرایط و قوانین استرداد",
        'nationalCard' => 'کارت ملی',
        'slug' => 'شناسه',
        'agreement' => 'قوانین و مقررات',
        'address_id' => 'نشانی',
        'state_id' => 'شهر',
        'status' => 'وضعیت',
        'قیمت' => 'وضعیت',
        'current_password' => 'رمز عبور فعلی',
        'purchase' => 'خرید',
        'callback' => 'آدرس برگشت',
        'amount' => 'مبلغ',
        'bank' => 'بانک',
        'image' => 'تصویر',
        'instagram_image' => 'آدرس تصویر اینستاگرام',
        'price' => 'قیمت',
        'category_id' => 'دسته بندی',
        'theme' => 'قالب',
        'shipping_method_id' => 'نحوه ارسال',
        'reason' => 'علت پرداخت',
        'pay_from_wallet' => 'پرداخت از کیف پول',
        /**
         * Attributes with *
         */
        "description.*" => "توضیحات",
        'prices.*' => 'قیمت',
        'prices' => 'قیمت',
        "name.*" => "نام",
        "social_image" => "تصویر شبکه اجتماعی",
        "social_id" => "شناسه شبکه اجتماعی",
        "network_id.*" => "شناسه شبکه اجتماعی",
        "slug.*" => 'شناسه',
        'quantities.*' => 'تعداد',
        'product_ids.*' => 'شناسه محصول',
        'product ids' => 'شناسه محصول',
        'discounts.*' => 'تخفیف',
        'estimated_days.*' => 'روزهای تخمین',
        'estimated days' => 'روزهای تخمین',
    ],
];
