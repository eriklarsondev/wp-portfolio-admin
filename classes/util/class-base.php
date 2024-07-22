<?php
namespace dev;

class Base
{
    public function __construct()
    {
    }

    protected function formatLabel($label, $divider = '_', $prefix = true)
    {
        $formatted = trim(strtolower($label));
        $formatted = preg_replace('/\s+/', $divider, $formatted);

        if ($prefix) {
            if (substr(0, 3) !== 'dev') {
                $formatted = 'dev' . $divider . $formatted;
            }
            return $formatted;
        }
        return $formatted;
    }
}
