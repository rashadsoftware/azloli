<?php

return [
    'accepted'             => ':attribute qəbul edilməlidir',
    'active_url'           => ':attribute doğru URL deyil',
    'after'                => ':attribute :date tarixindən sonra olmalıdır',
    'after_or_equal'       => ':attribute :date tarixi ilə eyni və ya sonra olmalıdır',
    'alpha'                => ':attribute yalnız hərflərdən ibarət ola bilər',
    'alpha_dash'           => ':attribute yalnız hərf, rəqəm və tire simvolundan ibarət ola bilər',
    'alpha_num'            => ':attribute yalnız hərf və rəqəmlərdən ibarət ola bilər',
    'array'                => ':attribute massiv formatında olmalıdır',
    'attached'             => 'Bu :attribute artıq əlavə olunur.',
    'before'               => ':attribute :date tarixindən əvvəl olmalıdır',
    'before_or_equal'      => ':attribute :date tarixindən əvvəl və ya bərabər olmalıdır',
    'between'              => [
        'array'   => ':attribute :min ilə :max intervalında hissədən ibarət olmalıdır',
        'file'    => ':attribute :min ilə :max KB ölçüsü intervalında olmalıdır',
        'numeric' => ':attribute :min ilə :max arasında olmalıdır',
        'string'  => ':attribute :min ilə :max simvolu intervalında olmalıdır',
    ],
    'boolean'              => ' :attribute doğru və ya yanlış ola bilər',
    'confirmed'            => ' :attribute doğrulanması yanlışdır',
    'date'                 => ' :attribute tarix formatında olmalıdır',
    'date_equals'          => ':attribute :date-ə bərabər bir tarix olmalıdır.',
    'date_format'          => ' :attribute :format formatında olmalıdır',
    'different'            => ' :attribute və :other fərqli olmalıdır',
    'digits'               => ' :attribute :digits rəqəmli olmalıdır',
    'digits_between'       => ' :attribute :min ilə :max rəqəmləri intervalında olmalıdır',
    'dimensions'           => ' :attribute doğru şəkil ölçülərində deyil',
    'distinct'             => ' :attribute dublikat qiymətlidir',
    'email'                => ' :attribute doğru email formatında deyil',
    'ends_with'            => ':attribute nömrəsi aşağıdakılardan biri ilə bitməlidir: :values.',
    'exists'               => ' seçilmiş :attribute yanlışdır',
    'file'                 => ' :attribute fayl formatında olmalıdır',
    'filled'               => ' :attribute qiyməti olmalıdır',
    'gt'                   => [
        'array'   => 'The :attribute must have more than :value items.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'numeric' => 'The :attribute must be greater than :value.',
        'string'  => 'The :attribute must be greater than :value characters.',
    ],
    'gte'                  => [
        'array'   => 'The :attribute must have :value items or more.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'string'  => 'The :attribute must be greater than or equal :value characters.',
    ],
    'image'                => ' :attribute şəkil formatında olmalıdır',
    'in'                   => ' seçilmiş :attribute yanlışdır',
    'in_array'             => ' :attribute :other qiymətləri arasında olmalıdır',
    'integer'              => ' :attribute tam ədəd olmalıdır',
    'ip'                   => ' :attribute İP adres formatında olmalıdır',
    'ipv4'                 => ' :attribute İPv4 adres formatında olmalıdır',
    'ipv6'                 => ' :attribute İPv6 adres formatında olmalıdır',
    'json'                 => ' :attribute JSON formatında olmalıdır',
    'lt'                   => [
        'array'   => 'The :attribute must have less than :value items.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'numeric' => 'The :attribute must be less than :value.',
        'string'  => 'The :attribute must be less than :value characters.',
    ],
    'lte'                  => [
        'array'   => 'The :attribute must not have more than :value items.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'numeric' => 'The :attribute must be less than or equal :value.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
    ],
    'max'                  => [
        'array'   => ' :attribute maksimum :max hədd\'dən ibarət ola bilər',
        'file'    => ' :attribute maksimum :max KB ölçüsündə ola bilər',
        'numeric' => ' :attribute maksiumum :max rəqəmdən ibarət ola bilər',
        'string'  => ' :attribute maksimum :max simvoldan ibarət olmalıdır',
    ],
    'mimes'                => ' :attribute :values tipində fayl olmalıdır',
    'mimetypes'            => ' :attribute :values tipində fayl olmalıdır',
    'min'                  => [
        'array'   => ' :attribute minimum :min hədd\'dən ibarət ola bilər',
        'file'    => ' :attribute minimum :min KB ölçüsündə ola bilər',
        'numeric' => ' :attribute minimum :min rəqəmdən ibarət ola bilər',
        'string'  => ' :attribute minimum :min simvoldan ibarət olmalıdır',
    ],
    'multiple_of'          => ':attribute, :value multiples olmalıdır',
    'not_in'               => ' seçilmiş :attribute yanlışdır',
    'not_regex'            => 'Format :attribute qəbuledilməzdir.',
    'numeric'              => ' :attribute rəqəmlərdən ibarət olmalıdır',
    'password'             => 'Şifrə səhvdir.',
    'present'              => ' :attribute iştirak etməlidir',
    'prohibited'           => ':attribute sahəsi qadağandır.',
    'prohibited_if'        => 'Sahəsində :attribute qadağan zaman :other-:value.',
    'prohibited_unless'    => ':attribute sahəsi yalnız :other :values-da olmadıqda qadağandır.',
    'regex'                => ' :attribute formatı yanlışdır',
    'relatable'            => 'Bu :attribute il bu resurs ilə bağlı ola bilər.',
    'required'             => ' :attribute boş buraxılmamalıdır',
    'required_if'          => ' :attribute (:other :value ikən) mütləqdir',
    'required_unless'      => ' :attribute (:other :values \'ə daxil ikən) mütləqdir',
    'required_with'        => ' :attribute (:values var ikən) mütləqdir',
    'required_with_all'    => ' :attribute (:values var ikən) mütləqdir',
    'required_without'     => ' :attribute (:values yox ikən) mütləqdir',
    'required_without_all' => ' :attribute (:values yox ikən) mütləqdir',
    'same'                 => ' :attribute və :other eyni olmalıdır',
    'size'                 => [
        'array'   => ' :attribute :size hədd\'dən ibarət olmalıdır',
        'file'    => ' :attribute :size KB ölçüsündə olmalıdır',
        'numeric' => ' :attribute :size ölçüsündə olmalıdır',
        'string'  => ' :attribute :size simvoldan ibarət olmalıdır',
    ],
    'starts_with'          => ':attribute aşağıdakılardan biri ilə başlamalıdır: :values.',
    'string'               => ' :attribute hərf formatında olmalıdır',
    'timezone'             => ' :attribute ərazi formatında olmalıdır',
    'unique'               => ' Bu :attribute istifadə olunub. Yenidən cəhd edin!',
    'uploaded'             => ' :attribute yüklənməsi mümkün olmadı',
    'url'                  => ' :attribute formatı yanlışdır',
    'uuid'                 => ':attribute etibarlı UUID olmalıdır.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes' => [
        // admin section -> login
        'email'                 => 'E-poçt',
        'password'              => 'Şifrə',
        // admin section -> company settings
        'companyTitle'          => 'Şirkətin adı',
        'companyEmail'          => 'Şirkətin E-poçtu',
        'companyEmail2'         => 'Şirkətin rezerv E-poçtu',
        'companyPhone'          => 'Əlaqə nömrəsi',
        'companyPhone2'         => 'Birinci rezerv əlaqə nömrəsi',
        'companyPhone3'         => 'İkinci rezerv əlaqə nömrəsi',
        'companyAddress'        => 'Şirkətin ünvanı',
        'companyDescription'    => 'Şirkət haqqında məlumat',
        'config_shortdescription'    => 'Şirkət haqqında qısa məlumat',
        'companyFacebook'       => 'Facebook addressi',
        'companyInstagram'      => 'İnstagram addressi',
        'companyWhatsapp'       => 'Whatsapp addressi',
        'companyYoutube'        => 'Youtube addressi',
        'companyVideoRolik'     => 'Video Rolik link addressi',
        'companyLogo'           => 'Şirkətin logosu',
        'companyFavicon'        => 'Şirkət faviconu',
        // admin section -> profile settings
        'exampleUser'           => 'İstifadəçi adı',
        'exampleEmail'          => 'E-mail ünvanı',
        'exampleAddress'        => 'Yaşayış ünvanınız',
        'exampleTextArea'      	=> 'Özünüz haqqında ətraflı məlumat sahəsi',
        'userPhone'      	    => 'Əlaqə nömrəsi',
        'exampleUserIP'         => 'IP Ünvan',
        'user_image'            => 'Şəkil sahəsi',
        'oldPassword'           => 'Köhnə şifrə',
        'newpassword'           => 'Yeni şifrə',
		// admin section -> category settings
        'exampleCategory'       => 'Kateqoriyanın adı',
        'exampleSubCategory'    => 'Alt kateqoriyanın adı',
        'exampleCategoryImage'  => 'Kateqoriyanın şəkli',
        'selectSkills'  		=> 'Bacarıqlar',
        'cat_title'  		    => 'Missiya başlığı',
        'cat_desc'  		    => 'Missiya detayı bölməsi',
        'exampleOffer'  		=> 'Təklif bölməsi',
        'imageMission'  		=> 'Missiya şəkil bölməsi',
        'imageOffer'  		    => 'Təklif şəkil bölməsi',
        'exampleBannerTitle'    => 'Banner başlığı',
        'exampleBannerSubTitle' => 'Banner alt başlığı',
        'exampleBannerImage'    => 'Banner şəkli',
        'examplePosition'       => 'Banner pozisyonu',

        // front section
        'name'                  =>'Adınız',
        'surname'               =>'Soyadınız',
        'phone'                 =>'Əlaqə nömrəniz',
        'theme'                 =>'Mövzu başlığı',
        'title'                 =>'Başlıq',
        'message'               =>'İsmarıc sahəsi',
        'username'              =>'İstifadəçi adı',
        'imageFile'             =>'Elan şəkli',
        'password_confirmation' =>'Təkrar şifrə',
        'job_image'             =>'Referans şəkillər',
        'selectCategory'        =>'Kateqoriya sahəsi',
    ],

];
