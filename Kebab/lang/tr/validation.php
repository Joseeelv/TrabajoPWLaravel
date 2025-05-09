<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Doğrulama Dil Satırları
  |--------------------------------------------------------------------------
  |
  | Aşağıdaki dil satırları, doğrulayıcı sınıfı tarafından kullanılan varsayılan
  | hata mesajlarını içerir. Bu kuralların bazıları, boyut kuralları gibi birden
  | fazla sürüme sahiptir. Bu mesajları burada istediğiniz gibi düzenleyebilirsiniz.
  |
  */

  'accepted' => ':attribute alanı kabul edilmelidir.',
  'accepted_if' => ':other :value olduğunda :attribute alanı kabul edilmelidir.',
  'active_url' => ':attribute alanı geçerli bir URL olmalıdır.',
  'after' => ':attribute alanı :date tarihinden sonraki bir tarih olmalıdır.',
  'after_or_equal' => ':attribute alanı :date tarihine eşit veya sonraki bir tarih olmalıdır.',
  'alpha' => ':attribute alanı yalnızca harflerden oluşmalıdır.',
  'alpha_dash' => ':attribute alanı yalnızca harfler, sayılar, tire ve alt çizgi içermelidir.',
  'alpha_num' => ':attribute alanı yalnızca harfler ve sayılardan oluşmalıdır.',
  'any_of' => ':attribute alanı geçersiz.',
  'array' => ':attribute alanı bir dizi olmalıdır.',
  'ascii' => ':attribute alanı yalnızca tek baytlık alfanümerik karakterler ve semboller içermelidir.',
  'before' => ':attribute alanı :date tarihinden önceki bir tarih olmalıdır.',
  'before_or_equal' => ':attribute alanı :date tarihine eşit veya önceki bir tarih olmalıdır.',
  'between' => [
    'array' => ':attribute alanı :min ile :max öğe arasında olmalıdır.',
    'file' => ':attribute alanı :min ile :max kilobayt arasında olmalıdır.',
    'numeric' => ':attribute alanı :min ile :max arasında olmalıdır.',
    'string' => ':attribute alanı :min ile :max karakter arasında olmalıdır.',
  ],
  'boolean' => ':attribute alanı doğru veya yanlış olmalıdır.',
  'can' => ':attribute alanı yetkisiz bir değer içeriyor.',
  'confirmed' => ':attribute alanı doğrulaması eşleşmiyor.',
  'contains' => ':attribute alanı gerekli bir değeri içermiyor.',
  'current_password' => 'Şifre yanlış.',
  'date' => ':attribute alanı geçerli bir tarih olmalıdır.',
  'date_equals' => ':attribute alanı :date tarihine eşit bir tarih olmalıdır.',
  'date_format' => ':attribute alanı :format formatıyla eşleşmelidir.',
  'decimal' => ':attribute alanı :decimal ondalık basamak içermelidir.',
  'declined' => ':attribute alanı reddedilmelidir.',
  'declined_if' => ':other :value olduğunda :attribute alanı reddedilmelidir.',
  'different' => ':attribute alanı ile :other farklı olmalıdır.',
  'digits' => ':attribute alanı :digits basamak olmalıdır.',
  'digits_between' => ':attribute alanı :min ile :max basamak arasında olmalıdır.',
  'dimensions' => ':attribute alanı geçersiz resim boyutlarına sahip.',
  'distinct' => ':attribute alanı yinelenen bir değere sahip.',
  'doesnt_end_with' => ':attribute alanı şu değerlerden biriyle bitmemelidir: :values.',
  'doesnt_start_with' => ':attribute alanı şu değerlerden biriyle başlamamalıdır: :values.',
  'email' => ':attribute alanı geçerli bir e-posta adresi olmalıdır.',
  'ends_with' => ':attribute alanı şu değerlerden biriyle bitmelidir: :values.',
  'enum' => 'Seçilen :attribute geçersiz.',
  'exists' => 'Seçilen :attribute geçersiz.',
  'extensions' => ':attribute alanı şu uzantılardan birine sahip olmalıdır: :values.',
  'file' => ':attribute alanı bir dosya olmalıdır.',
  'filled' => ':attribute alanı bir değere sahip olmalıdır.',
  'gt' => [
    'array' => ':attribute alanı :value öğeden fazla olmalıdır.',
    'file' => ':attribute alanı :value kilobayttan büyük olmalıdır.',
    'numeric' => ':attribute alanı :value değerinden büyük olmalıdır.',
    'string' => ':attribute alanı :value karakterden uzun olmalıdır.',
  ],
  'gte' => [
    'array' => ':attribute alanı :value öğe veya daha fazlasını içermelidir.',
    'file' => ':attribute alanı :value kilobayttan büyük veya eşit olmalıdır.',
    'numeric' => ':attribute alanı :value değerinden büyük veya eşit olmalıdır.',
    'string' => ':attribute alanı :value karakterden uzun veya eşit olmalıdır.',
  ],
  'hex_color' => ':attribute alanı geçerli bir onaltılık renk olmalıdır.',
  'image' => ':attribute alanı bir resim olmalıdır.',
  'in' => 'Seçilen :attribute geçersiz.',
  'in_array' => ':attribute alanı :other içinde bulunmalıdır.',
  'integer' => ':attribute alanı bir tam sayı olmalıdır.',
  'ip' => ':attribute alanı geçerli bir IP adresi olmalıdır.',
  'ipv4' => ':attribute alanı geçerli bir IPv4 adresi olmalıdır.',
  'ipv6' => ':attribute alanı geçerli bir IPv6 adresi olmalıdır.',
  'json' => ':attribute alanı geçerli bir JSON dizesi olmalıdır.',
  'list' => ':attribute alanı bir liste olmalıdır.',
  'lowercase' => ':attribute alanı küçük harf olmalıdır.',
  'lt' => [
    'array' => ':attribute alanı :value öğeden az olmalıdır.',
    'file' => ':attribute alanı :value kilobayttan küçük olmalıdır.',
    'numeric' => ':attribute alanı :value değerinden küçük olmalıdır.',
    'string' => ':attribute alanı :value karakterden kısa olmalıdır.',
  ],
  'lte' => [
    'array' => ':attribute alanı :value öğeden fazla olmamalıdır.',
    'file' => ':attribute alanı :value kilobayttan küçük veya eşit olmalıdır.',
    'numeric' => ':attribute alanı :value değerinden küçük veya eşit olmalıdır.',
    'string' => ':attribute alanı :value karakterden kısa veya eşit olmalıdır.',
  ],
  'mac_address' => ':attribute alanı geçerli bir MAC adresi olmalıdır.',
  'max' => [
    'array' => ':attribute alanı :max öğeden fazla olmamalıdır.',
    'file' => ':attribute alanı :max kilobayttan büyük olmamalıdır.',
    'numeric' => ':attribute alanı :max değerinden büyük olmamalıdır.',
    'string' => ':attribute alanı :max karakterden uzun olmamalıdır.',
  ],
  'max_digits' => ':attribute alanı :max basamaktan fazla olmamalıdır.',
  'mimes' => ':attribute alanı şu türlerden bir dosya olmalıdır: :values.',
  'mimetypes' => ':attribute alanı şu türlerden bir dosya olmalıdır: :values.',
  'min' => [
    'array' => ':attribute alanı en az :min öğe içermelidir.',
    'file' => ':attribute alanı en az :min kilobayt olmalıdır.',
    'numeric' => ':attribute alanı en az :min olmalıdır.',
    'string' => ':attribute alanı en az :min karakter olmalıdır.',
  ],
  'min_digits' => ':attribute alanı en az :min basamak içermelidir.',
  'missing' => ':attribute alanı eksik olmalıdır.',
  'missing_if' => ':other :value olduğunda :attribute alanı eksik olmalıdır.',
  'missing_unless' => ':other :value olmadıkça :attribute alanı eksik olmalıdır.',
  'missing_with' => ':values mevcut olduğunda :attribute alanı eksik olmalıdır.',
  'missing_with_all' => ':values mevcut olduğunda :attribute alanı eksik olmalıdır.',
  'multiple_of' => ':attribute alanı :value değerinin katı olmalıdır.',
  'not_in' => 'Seçilen :attribute geçersiz.',
  'not_regex' => ':attribute alanı formatı geçersiz.',
  'numeric' => ':attribute alanı bir sayı olmalıdır.',
  'password' => [
    'letters' => ':attribute alanı en az bir harf içermelidir.',
    'mixed' => ':attribute alanı en az bir büyük harf ve bir küçük harf içermelidir.',
    'numbers' => ':attribute alanı en az bir sayı içermelidir.',
    'symbols' => ':attribute alanı en az bir sembol içermelidir.',
    'uncompromised' => 'Verilen :attribute bir veri sızıntısında ortaya çıkmış. Lütfen farklı bir :attribute seçin.',
  ],
  'present' => ':attribute alanı mevcut olmalıdır.',
  'present_if' => ':other :value olduğunda :attribute alanı mevcut olmalıdır.',
  'present_unless' => ':other :value olmadıkça :attribute alanı mevcut olmalıdır.',
  'present_with' => ':values mevcut olduğunda :attribute alanı mevcut olmalıdır.',
  'present_with_all' => ':values mevcut olduğunda :attribute alanı mevcut olmalıdır.',
  'prohibited' => ':attribute alanı yasaktır.',
  'prohibited_if' => ':other :value olduğunda :attribute alanı yasaktır.',
  'prohibited_if_accepted' => ':other kabul edildiğinde :attribute alanı yasaktır.',
  'prohibited_if_declined' => ':other reddedildiğinde :attribute alanı yasaktır.',
  'prohibited_unless' => ':other :values içinde olmadıkça :attribute alanı yasaktır.',
  'prohibits' => ':attribute alanı :other alanının mevcut olmasını yasaklar.',
  'regex' => ':attribute alanı formatı geçersiz.',
  'required' => ':attribute alanı gereklidir.',
  'required_array_keys' => ':attribute alanı şu girişleri içermelidir: :values.',
  'required_if' => ':other :value olduğunda :attribute alanı gereklidir.',
  'required_if_accepted' => ':other kabul edildiğinde :attribute alanı gereklidir.',
  'required_if_declined' => ':other reddedildiğinde :attribute alanı gereklidir.',
  'required_unless' => ':other :values içinde olmadıkça :attribute alanı gereklidir.',
  'required_with' => ':values mevcut olduğunda :attribute alanı gereklidir.',
  'required_with_all' => ':values mevcut olduğunda :attribute alanı gereklidir.',
  'required_without' => ':values mevcut olmadığında :attribute alanı gereklidir.',
  'required_without_all' => ':values hiçbirisi mevcut olmadığında :attribute alanı gereklidir.',
  'same' => ':attribute alanı :other ile eşleşmelidir.',
  'size' => [
    'array' => ':attribute alanı :size öğe içermelidir.',
    'file' => ':attribute alanı :size kilobayt olmalıdır.',
    'numeric' => ':attribute alanı :size olmalıdır.',
    'string' => ':attribute alanı :size karakter olmalıdır.',
  ],
  'starts_with' => ':attribute alanı şu değerlerden biriyle başlamalıdır: :values.',
  'string' => ':attribute alanı bir dize olmalıdır.',
  'timezone' => ':attribute alanı geçerli bir zaman dilimi olmalıdır.',
  'unique' => ':attribute zaten alınmış.',
  'uploaded' => ':attribute yüklenemedi.',
  'uppercase' => ':attribute alanı büyük harf olmalıdır.',
  'url' => ':attribute alanı geçerli bir URL olmalıdır.',
  'ulid' => ':attribute alanı geçerli bir ULID olmalıdır.',
  'uuid' => ':attribute alanı geçerli bir UUID olmalıdır.',

  /*
  |--------------------------------------------------------------------------
  | Özel Doğrulama Dil Satırları
  |--------------------------------------------------------------------------
  |
  | Burada, belirli bir doğrulama kuralı için özel doğrulama mesajlarını
  | belirtmek için "attribute.rule" adlandırma kuralını kullanabilirsiniz.
  | Bu, belirli bir doğrulama kuralı için hızlı bir şekilde özel bir dil
  | satırı belirtmenizi sağlar.
  |
  */

  'custom' => [
    'attribute-name' => [
      'rule-name' => 'özel-mesaj',
    ],
  ],

  /*
  |--------------------------------------------------------------------------
  | Özel Doğrulama Özellikleri
  |--------------------------------------------------------------------------
  |
  | Aşağıdaki dil satırları, "E-Posta Adresi" gibi daha okunabilir bir şeyle
  | "email" gibi öznitelik yer tutucularını değiştirmek için kullanılır.
  | Bu, mesajlarımızı daha anlamlı hale getirmemize yardımcı olur.
  |
  */

  'attributes' => [],

];
