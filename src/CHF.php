<?php

namespace CHFFormat;

class CHF
{
    const translation = [
        'de' => [
            'fr' => 'Fr.',
            'rp' => 'Rp.',
            'fr_long' => 'Franken',
            'rp_long' => [
                'singular' => 'Rappen',
                'plural' => 'Rappen'
            ]
        ],
        'fr' => [
            'fr' => 'fr.',
            'rp' => 'c.',
            'fr_long' => 'franc',
            'rp_long' => [
                'singular' => 'centime',
                'plural' => 'centimes'
            ]
        ],
        'it' => [
            'fr' => 'fr.',
            'rp' => 'ct.',
            'fr_long' => 'franco',
            'rp_long' => [
                'singular' => 'centesimo',
                'plural' => 'centesimi'
            ]
        ],
        'rm' => [
            'fr' => 'fr.',
            'rp' => 'rp.',
            'fr_long' => 'franc',
            'rp_long' => [
                'singular' => 'rap',
                'plural' => 'rap'
            ]
        ]
    ];

    static function format(float $num, array $settings = [], string $lang = 'de'): string
    {
        $show_decimals = self::setting('show_decimals', true, $settings);
        $is_table = self::setting('is_table', false, $settings);
        $long = self::setting('long', false, $settings);
        $chf = self::setting('chf', false, $settings);
        $is_rp = ($num < 1) && !$show_decimals;

        $symbol = self::symbol($chf, $lang, $is_rp, $long, self::is_plural($num, $is_rp));
        $value = self::number_format($num, $show_decimals, (!$chf && $is_rp), $is_table);
        if ($show_decimals) {
            return "$symbol $value";
        } else {
            return "$value $symbol";
        }
    }

    private static function setting(string $key, bool $fallback, array $settings): bool
    {
        if (array_key_exists($key, $settings)) {
            return $settings[$key];
        }
        return $fallback;
    }

    private static function number_format(float $num, bool $show_decimals, bool $is_rp = false, bool $is_table = false): string
    {
        if ($is_rp) {
            return $num * 100;
        } else if (!$show_decimals) {
            return number_format($num, 0, '.', '&#8198;');
        } else {
            $value = number_format($num, 2, '.', '&#8198;');
            if ($is_table) {
                $value = str_replace(".00", ".&ndash;", $value);
                if ($num < 1) {
                    $value = str_replace("0.", "&ndash;.", $value);
                }
            }
            return $value;
        }
    }

    private static function symbol(bool $chf, string $lang = 'de', bool $is_rp = false, bool $long = false, bool $plural = true): string
    {
        if ($chf) {
            return "CHF";
        }

        $symbol = ($is_rp) ? 'rp' : 'fr';
        $symbol = ($long) ? $symbol . '_long' : $symbol;

        $result = match ($lang) {
            'fr', 'it', 'rm' => self::translation[$lang][$symbol],
            default => self::translation['de'][$symbol],
        };

        if ($long && $is_rp) {
            $symbol = ($plural) ? 'plural' : 'singular';
            return $result[$symbol];
        }
        return $result;
    }

    private static function is_plural($num, $is_rp): bool
    {
        $value = ($is_rp) ? $num * 100 : $num;
        return $value > 1;
    }
}