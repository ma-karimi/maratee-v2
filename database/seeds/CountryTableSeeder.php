<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Country::class, 50)->create();
        /*  $en_countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
          $fa_countries = ["افغانستان ",  "آلبانی ",  "الجزایر ",  "ساموآی آمریکا ",  "آندورا ",  "آنگولا ",  "آنگولیا ",  "قطب جنوب ",  "آنتیگوا و باربودا ",  "آرژانتین ",  "ارمنستان ",  "آروبا ",  "استرالیا ",  "اتریش ",  "آذربایجان ",  "باهاما ",  "بحرین ",  "بنگلادش ",  "باربادوس ",  "بلاروس ",  "بلژیک ",  "بلیز ",  "بنین ",  "برمودا ",  "بوتان ",  "بولیوی ",  "بوسنی و هرزگوین ",  "بوتسوانا ",  "جزیره بووت ",  "برزیل ",  "اقیانوس هند بریتانیا قلمرو  ", " برونئی  ", " بلغارستان  ", " بورکینافاسو  ", " بروندی  ", " کامبوج  ", " کامرون  ", " کانادا  ", " کیپ ورد  ", " جزایر کیمن  ", " جمهوری آفریقای مرکزی  ", " چاد  ", " شیلی  ", " چین  ", " جزیره کریسمس  ", " جزایر کوکوس (Keeling)  ", " کلمبیا  ", " کومور  ", " کنگو  ", " کنگو, جمهوری دموکراتیک  ", " جزایر کوک  ", " کاستاریکا  ", " ساحل عاج  ", " کرواسی (Hrvatska)  ", " کوبا  ", " قبرس  ", " جمهوری چک  ", " دانمارک  ", " جیبوتی  ", " دومینیکا  ", " جمهوری دومینیکن  ", " تیمور شرقی  ", " اکوادور  ", " مصر  ", " السالوادور  ", " گینه استوایی  ", " اریتره  ", " استونی  ", " اتیوپی  ", " جزایر فالکلند (مالویناس)  ", " جزایر فارو  ", " فیجی  ", " فنلاند  ", " فرانسه  " ,  "متروپولیتن فرانسه ",  "گویان فرانسه ",  "پلینزی فرانسه ",  "سرزمین های جنوبی فرانسه ",  "گابن ",  "گامبیا ",  "گرجستان ",  "آلمان ",  "غنا ",  "جبل الطارق ",  "یونان ",  "گرینلند ",  "گرانادا ",  "گوادلوپ ",  "گوام ",  " گواتمالا  ", " گینه  ", " گینه بیسائو  ", " گویان  ", " هائیتی  ", " هرد و جزایر Mc دونالد  ", " مقدس See (واتیکان دولت شهر)  ", " هندوراس  ", " هنگ کنگ  ", " مجارستان  ", " ایسلند  ", " هند  ", " اندونزی  ", " ایران (جمهوری اسلامی)  ", " عراق  ", " ایرلند  ", " اسرائیل  ", " ایتالیا  ", " جامائیکا  ", " ژاپن  ", " اردن  ", " قزاقستان  ", " کنیا  ", " کریباتی  ", " کره, جمهوری خلق دموکرات  ", " کره, جمهوری  ", " کویت  ", " قرقیزستان  ", " Lao, مردم دموکراتیک جمهوری  ", " لتونی  ", " لبنان  ", " لسوتو  ", " لیبریا ", " جماعت عرب لیبی  ", " لیختن اشتاین  ", " لیتوانی  ", " لوکزامبورگ  ", " ماکائو  ", " مقدونیه, جمهوری یوگسلاوی سابق  ", " ماداگاسکار  ", " مالاوی  ", " مالزی  ", " مالدیو  ", " مالی  ", " مالت  ", " جزایر مارشال  ", " مارتینیک  ", " موریتانی  ", " موریس  ", " مایوته  ", " مکزیک  ", " میکرونزی, ایالات فدرال  ", " مولدووا, جمهوری  ", " موناکو  ", " مغولستان  ", " مونتسرات  ", " مراکش  ",  "موزامبیک ",  "میانمار ",  "نامیبیا ",  "نایورو ",  "نپال ",  "هلند ",  "آنتیل هلند ",  "کالدونیای جدید ",  "زلاند نو",  "نیکاراگوئه ",  "نیجر ",  "نیجریه ",  "Niue ",  "جزیره نورفولک ",  "جزایر ماریانای شمالی ",  " نروژ  ", " عمان  ", " پاکستان  ", " پالائو  ", " پاناما  ", " پاپوآ گینه نو ", " پاراگوئه  ", " پرو  ", " فیلیپین  ", " پیت کرن  ", " لهستان  ", " پرتغال  ", " پورتوریکو  ", " قطر  ", " ریونیون  ", " رومانی  ", " فدراسیون روسیه  ", " رواندا  ", " سنت کیتس و نویس  ", " سنت لوسیا  ", " سنت وینسنت و گرنادین  ", " ساموا  ", " سان مارینو  ", " سائو تومه و پرینسیپ  ", " عربستان سعودی  ", " سنگال  ", " سیشل  ", " سیرا لئون  ", " سنگاپور  ", " اسلواکی (جمهوری اسلواکی)  ", " اسلوونی  ", " جزایر سلیمان  ", " سومالی  ", " آفریقای جنوبی  ", " جورجیای جنوبی و جزایر ساندویچ جنوبی  ", " اسپانیا  ", " سری لانکا  ", " سنت هلنا  ", " سنت پیر و میکلون  ", " سودان  ", " سورینام  ", " سوالبارد و جان ماین جزایر  ", " سوازیلند  ", " سوئد  ", " سوئیس  ", " جمهوری عربی سوریه  ", " تایوان, استان چین  ", " تاجیکستان  ", " تانزانیا, جمهوری متحده  ", " تایلند  ", " توگو  ", " Tokelau  ", " تونگا  ", " ترینیداد و توباگو  ", " تونس  ", " ترکیه  ", " ترکمنستان  ", " جزایر ترکس و کایکوس  ", " تووالو  ", " اوگاندا  ", " اوکراین  ", " امارات متحده عربی  ", " بریتانیا  ", " ایالات متحده  ", " جزایر کوچک دورافتاده ایالات متحده  ", " اروگوئه  ", " ازبکستان  ", " وانواتو  ", " ونزوئلا  ", " ویتنام  ", " جزایر ویرجین (انگلیسی)  ", " جزایر ویرجین (ایالات متحده)  ", " جزایر والیس و فوتونا  ", " صحرای غربی  ", " یمن  ", " یوگسلاوی  ", " زامبیا  ", " زیمبابوه"];
          foreach ($en_countries as $index => $item) {
              \App\Models\Country::create([
                  'name'=>['fa'=>$fa_countries[$index],'en'=>$item],
              ]);
          }*/
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('countries')->truncate();
        $countries = new \PragmaRX\Countries\Package\Countries();
        foreach ($countries->all() as $index => $item) {
            if (!empty($item->geo)) {
                try {
                    if (is_object($item->geo->continent)) {
                        $continent_name = $item->geo->continent->first();
                    }
                    $continent_id = \App\Models\Continent::where('name', 'LIKE', "%$continent_name%")->first()->id;
                } catch (\Exception $exception) {
                }
            }
            \App\Models\Country::create([
                'name' => ['en' => $item->name->common],
                'continent_id' => $continent_id ?? null,
                'code' => $item->iso_n3 ?? null
            ]);
            exec('echo "jaysvdjavsdfh"');
            print_r('asdasd');

        }
    }
}
