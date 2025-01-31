<?

use Bitrix\Main\Loader;
use Bitrix\Iblock;
use Bitrix\Main\Data\Cache;

define('REPORTS_IBLOCK_ID', 1);
define('ADVERT_IBLOCK_ID', 6);
define('ADVERT_IBLOCK_TYPE', 'Advert');
define('REPORTS_IBLOCK_TYPE', 'reports');
define('DEFAULT_CACHE_TIME', 3600);

$currentPage = $APPLICATION->getCurPage();

AddEventHandler("main", "OnUserLogout", "logoutCustomHandler");

///////////////////////////////////////////////////////////////////////////////

function logoutCustomHandler() {
    global $currentPage;
    if ($currentPage != '/') {
        LocalRedirect('/?logout=yes');
    }
}

function translit($string, $replacer = '-')
{
    return CUtil::translit($string, 'ru', Array(
        'replace_space' => $replacer,
        'replace_other' => $replacer
    ));
}

function getCutString($string, $length)
{
    $string = strip_tags($string);
    if (mb_strlen($string, 'UTF-8') > $length) {
        $pos = mb_strpos($string, ' ', $length, 'UTF-8');

        if ($pos === false) {
            $pos = $length;
        }

        $string = mb_substr($string, 0, $pos, 'UTF-8');
        return $string . '…';
    } else
        return $string;
}