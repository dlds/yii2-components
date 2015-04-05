<?php

namespace dlds\components\validators\isocode;

class Iban extends ISOValidator {

    const MODULUS = 97;
    const LENGTH_MIN = 15;
    const PATTERNS = [
        'AL' => '[0-9]{8}[0-9A-Z]{16}',
        'AD' => '[0-9]{8}[0-9A-Z]{12}',
        'AT' => '[0-9]{16}',
        'BE' => '[0-9]{12}',
        'BA' => '[0-9]{16}',
        'BG' => '[A-Z]{4}[0-9]{6}[0-9A-Z]{8}',
        'HR' => '[0-9]{17}',
        'CY' => '[0-9]{8}[0-9A-Z]{16}',
        'CZ' => '[0-9]{20}',
        'DK' => '[0-9]{14}',
        'EE' => '[0-9]{16}',
        'FO' => '[0-9]{14}',
        'FI' => '[0-9]{14}',
        'FR' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}',
        'PF' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Polynesia
        'TF' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Southern Territories
        'GP' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Guadeloupe
        'MQ' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Martinique
        'YT' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Mayotte
        'NC' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // New Caledonia
        'RE' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Reunion
        'BL' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Saint Barthelemy
        'MF' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // French Saint Martin
        'PM' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // Saint Pierre et Miquelon
        'WF' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}', // Wallis and Futuna Islands
        'GE' => '[0-9A-Z]{2}[0-9]{16}',
        'DE' => '[0-9]{18}',
        'GI' => '[A-Z]{4}[0-9A-Z]{15}',
        'GR' => '[0-9]{7}[0-9A-Z]{16}',
        'GL' => '[0-9]{14}',
        'HU' => '[0-9]{24}',
        'IS' => '[0-9]{22}',
        'IE' => '[0-9A-Z]{4}[0-9]{14}',
        'IL' => '[0-9]{19}',
        'IT' => '[A-Z][0-9]{10}[0-9A-Z]{12}',
        'KZ' => '[0-9]{3}[0-9A-Z]{3}[0-9]{10}',
        'KW' => '[A-Z]{4}[0-9]{22}',
        'LV' => '[A-Z]{4}[0-9A-Z]{13}',
        'LB' => '[0-9]{4}[0-9A-Z]{20}',
        'LI' => '[0-9]{5}[0-9A-Z]{12}',
        'LT' => '[0-9]{16}',
        'LU' => '[0-9]{3}[0-9A-Z]{13}',
        'MK' => '[0-9]{3}[0-9A-Z]{10}[0-9]{2}',
        'MT' => '[A-Z]{4}[0-9]{5}[0-9A-Z]{18}',
        'MR' => '[0-9]{23}',
        'MU' => '[A-Z]{4}[0-9]{19}[A-Z]{3}',
        'MC' => '[0-9]{10}[0-9A-Z]{11}[0-9]{2}',
        'ME' => '[0-9]{18}',
        'NL' => '[A-Z]{4}[0-9]{10}',
        'NO' => '[0-9]{11}',
        'PL' => '[0-9]{24}',
        'PT' => '[0-9]{21}',
        'RO' => '[A-Z]{4}[0-9A-Z]{16}',
        'SM' => '[A-Z][0-9]{10}[0-9A-Z]{12}',
        'SA' => '[0-9]{2}[0-9A-Z]{18}',
        'RS' => '[0-9]{18}',
        'SK' => '[0-9]{20}',
        'SI' => '[0-9]{15}',
        'ES' => '[0-9]{20}',
        'SE' => '[0-9]{20}',
        'CH' => '[0-9]{5}[0-9A-Z]{12}',
        'TN' => '[0-9]{20}',
        'TR' => '[0-9]{5}[0-9A-Z]{17}',
        'AE' => '[0-9]{19}',
        'GB' => '[A-Z]{4}[0-9]{14}',
        'CI' => '[0-9A-Z]{2}[0-9]{22}'
    ];
    /**
     * @inheritdoc
     */
    public function validateValue($value)
    {
        $patterns = self::PATTERNS;

        if (mb_strlen($value) < self::LENGTH_MIN)
        {
            return false;
        }

        $ctr = substr($value, 0, 2);

        if (isset($patterns[$ctr]) === false)
        {
            return false;
        }

        $check = substr($value, 4);

        if (preg_match('~' . $patterns[$ctr] . '~', $check) !== 1)
        {
            return false;
        }

        $check = $check . substr($value, 0, 4);

        $check = str_replace(
                ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'], ['10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35'], $check
        );

        return bcmod($check, self::MODULUS) === '1';
    }

}
