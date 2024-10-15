<?php

namespace App\Helpers;

class PaymentCurrencyHelper
{
    Const CURRENCY_DETAIL = [
        array("name" => "Afghan Afghani", "code" => "AFA", "symbol" => "؋", "id" => 1),
        array("name" => "Albanian Lek", "code" => "ALL", "symbol" => "Lek", "id" => 2),
        array("name" => "Algerian Dinar", "code" => "DZD", "symbol" => "دج", "id" => 3),
        array("name" => "Angolan Kwanza", "code" => "AOA", "symbol" => "Kz", "id" => 4),
        array("name" => "Argentine Peso", "code" => "ARS", "symbol" => "$", "id" => 5),
        array("name" => "Armenian Dram", "code" => "AMD", "symbol" => "֏", "id" => 6),
        array("name" => "Aruban Florin", "code" => "AWG", "symbol" => "ƒ", "id" => 7),
        array("name" => "Australian Dollar", "code" => "AUD", "symbol" => "$", "id" => 8),
        array("name" => "Azerbaijani Manat", "code" => "AZN", "symbol" => "m", "id" => 9),
        array("name" => "Bahamian Dollar", "code" => "BSD", "symbol" => "B$", "id" => 10),
        array("name" => "Bahraini Dinar", "code" => "BHD", "symbol" => ".د.ب", "id" => 11),
        array("name" => "Bangladeshi Taka", "code" => "BDT", "symbol" => "৳", "id" => 12),
        array("name" => "Barbadian Dollar", "code" => "BBD", "symbol" => "Bds$", "id" => 13),
        array("name" => "Belarusian Ruble", "code" => "BYR", "symbol" => "Br", "id" => 14),
        array("name" => "Belgian Franc", "code" => "BEF", "symbol" => "fr", "id" => 15),
        array("name" => "Belize Dollar", "code" => "BZD", "symbol" => "$", "id" => 16),
        array("name" => "Bermudan Dollar", "code" => "BMD", "symbol" => "$", "id" => 17),
        array("name" => "Bhutanese Ngultrum", "code" => "BTN", "symbol" => "Nu.", "id" => 18),
        array("name" => "Bitcoin", "code" => "BTC", "symbol" => "฿", "id" => 19),
        array("name" => "Bolivian Boliviano", "code" => "BOB", "symbol" => "Bs.", "id" => 20),
        array("name" => "Bosnia-Herzegovina Convertible Mark", "code" => "BAM", "symbol" => "KM", "id" => 21),
        array("name" => "Botswanan Pula", "code" => "BWP", "symbol" => "P", "id" => 22),
        array("name" => "Brazilian Real", "code" => "BRL", "symbol" => "R$", "id" => 23),
        array("name" => "British Pound Sterling", "code" => "GBP", "symbol" => "£", "id" => 24),
        array("name" => "Brunei Dollar", "code" => "BND", "symbol" => "B$", "id" => 25),
        array("name" => "Bulgarian Lev", "code" => "BGN", "symbol" => "Лв.", "id" => 26),
        array("name" => "Burundian Franc", "code" => "BIF", "symbol" => "FBu", "id" => 27),
        array("name" => "Cambodian Riel", "code" => "KHR", "symbol" => "KHR", "id" => 28),
        array("name" => "Canadian Dollar", "code" => "CAD", "symbol" => "$", "id" => 29),
        array("name" => "Cape Verdean Escudo", "code" => "CVE", "symbol" => "$", "id" => 30),
        array("name" => "Cayman Islands Dollar", "code" => "KYD", "symbol" => "$", "id" => 31),
        array("name" => "CFA Franc BCEAO", "code" => "XOF", "symbol" => "CFA", "id" => 32),
        array("name" => "CFA Franc BEAC", "code" => "XAF", "symbol" => "FCFA", "id" => 33),
        array("name" => "CFP Franc", "code" => "XPF", "symbol" => "₣", "id" => 34),
        array("name" => "Chilean Peso", "code" => "CLP", "symbol" => "$", "id" => 35),
        array("name" => "Chilean Unit of Account", "code" => "CLF", "symbol" => "CLF", "id" => 36),
        array("name" => "Chinese Yuan", "code" => "CNY", "symbol" => "¥", "id" => 37),
        array("name" => "Colombian Peso", "code" => "COP", "symbol" => "$", "id" => 38),
        array("name" => "Comorian Franc", "code" => "KMF", "symbol" => "CF", "id" => 39),
        array("name" => "Congolese Franc", "code" => "CDF", "symbol" => "FC", "id" => 40),
        array("name" => "Costa Rican Colón", "code" => "CRC", "symbol" => "₡", "id" => 41),
        array("name" => "Croatian Kuna", "code" => "HRK", "symbol" => "kn", "id" => 42),
        array("name" => "Cuban Convertible Peso", "code" => "CUC", "symbol" => "$, CUC", "id" => 43),
        array("name" => "Czech Republic Koruna", "code" => "CZK", "symbol" => "Kč", "id" => 44),
        array("name" => "Danish Krone", "code" => "DKK", "symbol" => "Kr.", "id" => 45),
        array("name" => "Djiboutian Franc", "code" => "DJF", "symbol" => "Fdj", "id" => 46),
        array("name" => "Dominican Peso", "code" => "DOP", "symbol" => "$", "id" => 47),
        array("name" => "East Caribbean Dollar", "code" => "XCD", "symbol" => "$", "id" => 48),
        array("name" => "Egyptian Pound", "code" => "EGP", "symbol" => "ج.م", "id" => 49),
        array("name" => "Eritrean Nakfa", "code" => "ERN", "symbol" => "Nfk", "id" => 50),
        array("name" => "Estonian Kroon", "code" => "EEK", "symbol" => "kr", "id" => 51),
        array("name" => "Ethiopian Birr", "code" => "ETB", "symbol" => "Nkf", "id" => 52),
        array("name" => "Euro", "code" => "EUR", "symbol" => "€", "id" => 53),
        array("name" => "Falkland Islands Pound", "code" => "FKP", "symbol" => "£", "id" => 54),
        array("name" => "Fijian Dollar", "code" => "FJD", "symbol" => "FJ$", "id" => 55),
        array("name" => "Gambian Dalasi", "code" => "GMD", "symbol" => "D", "id" => 56),
        array("name" => "Georgian Lari", "code" => "GEL", "symbol" => "ლ", "id" => 57),
        array("name" => "German Mark", "code" => "DEM", "symbol" => "DM", "id" => 58),
        array("name" => "Ghanaian Cedi", "code" => "GHS", "symbol" => "GH₵", "id" => 59),
        array("name" => "Gibraltar Pound", "code" => "GIP", "symbol" => "£", "id" => 60),
        array("name" => "Greek Drachma", "code" => "GRD", "symbol" => "₯, Δρχ, Δρ", "id" => 61),
        array("name" => "Guatemalan Quetzal", "code" => "GTQ", "symbol" => "Q", "id" => 62),
        array("name" => "Guinean Franc", "code" => "GNF", "symbol" => "FG", "id" => 63),
        array("name" => "Guyanaese Dollar", "code" => "GYD", "symbol" => "$", "id" => 64),
        array("name" => "Haitian Gourde", "code" => "HTG", "symbol" => "G", "id" => 65),
        array("name" => "Honduran Lempira", "code" => "HNL", "symbol" => "L", "id" => 66),
        array("name" => "Hong Kong Dollar", "code" => "HKD", "symbol" => "$", "id" => 67),
        array("name" => "Hungarian Forint", "code" => "HUF", "symbol" => "Ft", "id" => 68),
        array("name" => "Icelandic Króna", "code" => "ISK", "symbol" => "kr", "id" => 69),
        array("name" => "Indian Rupee", "code" => "INR", "symbol" => "₹", "id" => 70),
        array("name" => "Indonesian Rupiah", "code" => "IDR", "symbol" => "Rp", "id" => 71),
        array("name" => "Iranian Rial", "code" => "IRR", "symbol" => "﷼", "id" => 72),
        array("name" => "Iraqi Dinar", "code" => "IQD", "symbol" => "د.ع", "id" => 73),
        array("name" => "Israeli New Sheqel", "code" => "ILS", "symbol" => "₪", "id" => 74),
        array("name" => "Italian Lira", "code" => "ITL", "symbol" => "L,£", "id" => 75),
        array("name" => "Jamaican Dollar", "code" => "JMD", "symbol" => "J$", "id" => 76),
        array("name" => "Japanese Yen", "code" => "JPY", "symbol" => "¥", "id" => 77),
        array("name" => "Jordanian Dinar", "code" => "JOD", "symbol" => "ا.د", "id" => 78),
        array("name" => "Kazakhstani Tenge", "code" => "KZT", "symbol" => "лв", "id" => 79),
        array("name" => "Kenyan Shilling", "code" => "KES", "symbol" => "KSh", "id" => 80),
        array("name" => "Kuwaiti Dinar", "code" => "KWD", "symbol" => "ك.د", "id" => 81),
        array("name" => "Kyrgystani Som", "code" => "KGS", "symbol" => "лв", "id" => 82),
        array("name" => "Laotian Kip", "code" => "LAK", "symbol" => "₭", "id" => 83),
        array("name" => "Latvian Lats", "code" => "LVL", "symbol" => "Ls", "id" => 84),
        array("name" => "Lebanese Pound", "code" => "LBP", "symbol" => "£", "id" => 85),
        array("name" => "Lesotho Loti", "code" => "LSL", "symbol" => "L", "id" => 86),
        array("name" => "Liberian Dollar", "code" => "LRD", "symbol" => "$", "id" => 87),
        array("name" => "Libyan Dinar", "code" => "LYD", "symbol" => "د.ل", "id" => 88),
        array("name" => "Litecoin", "code" => "LTC", "symbol" => "Ł", "id" => 89),
        array("name" => "Lithuanian Litas", "code" => "LTL", "symbol" => "Lt", "id" => 90),
        array("name" => "Macanese Pataca", "code" => "MOP", "symbol" => "$", "id" => 91),
        array("name" => "Macedonian Denar", "code" => "MKD", "symbol" => "ден", "id" => 92),
        array("name" => "Malagasy Ariary", "code" => "MGA", "symbol" => "Ar", "id" => 93),
        array("name" => "Malawian Kwacha", "code" => "MWK", "symbol" => "MK", "id" => 94),
        array("name" => "Malaysian Ringgit", "code" => "MYR", "symbol" => "RM", "id" => 95),
        array("name" => "Maldivian Rufiyaa", "code" => "MVR", "symbol" => "Rf", "id" => 96),
        array("name" => "Mauritanian Ouguiya", "code" => "MRO", "symbol" => "MRU", "id" => 97),
        array("name" => "Mauritian Rupee", "code" => "MUR", "symbol" => "₨", "id" => 98),
        array("name" => "Mexican Peso", "code" => "MXN", "symbol" => "$", "id" => 99),
        array("name" => "Moldovan Leu", "code" => "MDL", "symbol" => "L", "id" => 100),
        array("name" => "Mongolian Tugrik", "code" => "MNT", "symbol" => "₮", "id" => 101),
        array("name" => "Moroccan Dirham", "code" => "MAD", "symbol" => "MAD", "id" => 102),
        array("name" => "Mozambican Metical", "code" => "MZM", "symbol" => "MT", "id" => 103),
        array("name" => "Myanmar Kyat", "code" => "MMK", "symbol" => "K", "id" => 104),
        array("name" => "Namibian Dollar", "code" => "NAD", "symbol" => "$", "id" => 105),
        array("name" => "Nepalese Rupee", "code" => "NPR", "symbol" => "₨", "id" => 106),
        array("name" => "Netherlands Antillean Guilder", "code" => "ANG", "symbol" => "ƒ", "id" => 107),
        array("name" => "New Taiwan Dollar", "code" => "TWD", "symbol" => "$", "id" => 108),
        array("name" => "New Zealand Dollar", "code" => "NZD", "symbol" => "$", "id" => 109),
        array("name" => "Nicaraguan Córdoba", "code" => "NIO", "symbol" => "C$", "id" => 110),
        array("name" => "Nigerian Naira", "code" => "NGN", "symbol" => "₦", "id" => 111),
        array("name" => "North Korean Won", "code" => "KPW", "symbol" => "₩", "id" => 112),
        array("name" => "Norwegian Krone", "code" => "NOK", "symbol" => "kr", "id" => 113),
        array("name" => "Omani Rial", "code" => "OMR", "symbol" => ".ع.ر", "id" => 114),
        array("name" => "Pakistani Rupee", "code" => "PKR", "symbol" => "₨", "id" => 115),
        array("name" => "Panamanian Balboa", "code" => "PAB", "symbol" => "B/.", "id" => 116),
        array("name" => "Papua New Guinean Kina", "code" => "PGK", "symbol" => "K", "id" => 117),
        array("name" => "Paraguayan Guarani", "code" => "PYG", "symbol" => "₲", "id" => 118),
        array("name" => "Peruvian Nuevo Sol", "code" => "PEN", "symbol" => "S/.", "id" => 119),
        array("name" => "Philippine Peso", "code" => "PHP", "symbol" => "₱", "id" => 120),
        array("name" => "Polish Zloty", "code" => "PLN", "symbol" => "zł", "id" => 121),
        array("name" => "Qatari Rial", "code" => "QAR", "symbol" => "ق.ر", "id" => 122),
        array("name" => "Romanian Leu", "code" => "RON", "symbol" => "lei", "id" => 123),
        array("name" => "Russian Ruble", "code" => "RUB", "symbol" => "₽", "id" => 124),
        array("name" => "Rwandan Franc", "code" => "RWF", "symbol" => "FRw", "id" => 125),
        array("name" => "Salvadoran Colón", "code" => "SVC", "symbol" => "₡", "id" => 126),
        array("name" => "Samoan Tala", "code" => "WST", "symbol" => "SAT", "id" => 127),
        array("name" => "São Tomé and Príncipe Dobra", "code" => "STD", "symbol" => "Db", "id" => 128),
        array("name" => "Saudi Riyal", "code" => "SAR", "symbol" => "﷼", "id" => 129),
        array("name" => "Serbian Dinar", "code" => "RSD", "symbol" => "din", "id" => 130),
        array("name" => "Seychellois Rupee", "code" => "SCR", "symbol" => "SRe", "id" => 131),
        array("name" => "Sierra Leonean Leone", "code" => "SLL", "symbol" => "Le", "id" => 132),
        array("name" => "Singapore Dollar", "code" => "SGD", "symbol" => "$", "id" => 133),
        array("name" => "Slovak Koruna", "code" => "SKK", "symbol" => "Sk", "id" => 134),
        array("name" => "Solomon Islands Dollar", "code" => "SBD", "symbol" => "Si$", "id" => 135),
        array("name" => "Somali Shilling", "code" => "SOS", "symbol" => "Sh.so.", "id" => 136),
        array("name" => "South African Rand", "code" => "ZAR", "symbol" => "R", "id" => 137),
        array("name" => "South Korean Won", "code" => "KRW", "symbol" => "₩", "id" => 138),
        array("name" => "South Sudanese Pound", "code" => "SSP", "symbol" => "£", "id" => 139),
        array("name" => "Special Drawing Rights", "code" => "XDR", "symbol" => "SDR", "id" => 140),
        array("name" => "Sri Lankan Rupee", "code" => "LKR", "symbol" => "Rs", "id" => 141),
        array("name" => "St. Helena Pound", "code" => "SHP", "symbol" => "£", "id" => 142),
        array("name" => "Sudanese Pound", "code" => "SDG", "symbol" => ".س.ج", "id" => 143),
        array("name" => "Surinamese Dollar", "code" => "SRD", "symbol" => "$", "id" => 144),
        array("name" => "Swazi Lilangeni", "code" => "SZL", "symbol" => "E", "id" => 145),
        array("name" => "Swedish Krona", "code" => "SEK", "symbol" => "kr", "id" => 146),
        array("name" => "Swiss Franc", "code" => "CHF", "symbol" => "CHf", "id" => 147),
        array("name" => "Syrian Pound", "code" => "SYP", "symbol" => "LS", "id" => 148),
        array("name" => "Tajikistani Somoni", "code" => "TJS", "symbol" => "SM", "id" => 149),
        array("name" => "Tanzanian Shilling", "code" => "TZS", "symbol" => "TSh", "id" => 150),
        array("name" => "Thai Baht", "code" => "THB", "symbol" => "฿", "id" => 151),
        array("name" => "Tongan Pa'anga", "code" => "TOP", "symbol" => "$", "id" => 152),
        array("name" => "Trinidad & Tobago Dollar", "code" => "TTD", "symbol" => "$", "id" => 153),
        array("name" => "Tunisian Dinar", "code" => "TND", "symbol" => "ت.د", "id" => 154),
        array("name" => "Turkish Lira", "code" => "TRY", "symbol" => "₺", "id" => 155),
        array("name" => "Turkmenistani Manat", "code" => "TMT", "symbol" => "T", "id" => 156),
        array("name" => "Ugandan Shilling", "code" => "UGX", "symbol" => "USh", "id" => 157),
        array("name" => "Ukrainian Hryvnia", "code" => "UAH", "symbol" => "₴", "id" => 158),
        array("name" => "United Arab Emirates Dirham", "code" => "AED", "symbol" => "إ.د", "id" => 159),
        array("name" => "Uruguayan Peso", "code" => "UYU", "symbol" => "$", "id" => 160),
        array("name" => "US Dollar", "code" => "USD", "symbol" => "$", "id" => 161),
        array("name" => "Uzbekistan Som", "code" => "UZS", "symbol" => "лв", "id" => 162),
        array("name" => "Vanuatu Vatu", "code" => "VUV", "symbol" => "VT", "id" => 163),
        array("name" => "Venezuelan BolÃvar", "code" => "VEF", "symbol" => "Bs", "id" => 164),
        array("name" => "Vietnamese Dong", "code" => "VND", "symbol" => "₫", "id" => 165),
        array("name" => "Yemeni Rial", "code" => "YER", "symbol" => "﷼", "id" => 166),
        array("name" => "Zambian Kwacha", "code" => "ZMK", "symbol" => "ZK", "id" => 167),
        array("name" => "Zimbabwean dollar", "code" => "ZWL", "symbol" => "$", "id" => 168)
    ];
}