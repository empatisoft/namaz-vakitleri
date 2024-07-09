# Diyanet İşleri Başkanlığı - Namaz API

Diyanet İşleri Başkanlığı web sitesinde yer alan namaz vakitlerini JSON çıktı olarak üretir.

## JSON Çıktı için

```php
$data = $diyanet->getData('tr-TR/9541/istanbul-icin-namaz-vakti', 'monthly', 0);
```

```json
[
    {
        "miladi": "09 Temmuz 2024 Salı",
        "hicri": "Muharrem 1446",
        "imsak": "03:37",
        "gunes": "05:34",
        "ogle": "13:14",
        "ikindi": "17:13",
        "aksam": "20:45",
        "yatsi": "22:33",
        "date": "2024-07-09"
    },
    {
        "miladi": "10 Temmuz 2024 Çarşamba",
        "hicri": "Muharrem 1446",
        "imsak": "03:38",
        "gunes": "05:34",
        "ogle": "13:15",
        "ikindi": "17:13",
        "aksam": "20:45",
        "yatsi": "22:32",
        "date": "2024-07-10"
    }
]
```

## Object/Array Çıktı için

```php
$data = $diyanet->getData('tr-TR/9541/istanbul-icin-namaz-vakti', 'monthly', 1);
```

```php
Array
(
    [0] => stdClass Object
        (
            [miladi] => 09 Temmuz 2024 Salı
            [hicri] => Muharrem 1446
            [imsak] => 03:37
            [gunes] => 05:34
            [ogle] => 13:14
            [ikindi] => 17:13
            [aksam] => 20:45
            [yatsi] => 22:33
            [date] => 2024-07-09
        )

    [1] => stdClass Object
        (
            [miladi] => 10 Temmuz 2024 Çarşamba
            [hicri] => Muharrem 1446
            [imsak] => 03:38
            [gunes] => 05:34
            [ogle] => 13:15
            [ikindi] => 17:13
            [aksam] => 20:45
            [yatsi] => 22:32
            [date] => 2024-07-10
        )
)
```