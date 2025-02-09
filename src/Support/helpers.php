<?php

declare(strict_types=1);

use Orchid\Alert\Alert;
use Orchid\Filters\HttpFilter;
use Orchid\Support\Color;

if (! function_exists('alert')) {
    /**
     * Helper function to send an alert.
     *
     * @param string|null $message
     * @param string|null $level
     *
     * @return Alert
     */
    function alert(string $message = null, string $level = null): Alert
    {
        $notifier = app(Alert::class);

        if ($level !== null) {
            $level = (string) Color::INFO();
        }

        if ($message !== null) {
            return $notifier->message($message, $level);
        }

        return $notifier;
    }
}

if (! function_exists('is_sort')) {
    /**
     * @param string $property
     *
     * @return bool
     */
    function is_sort(string $property): bool
    {
        $filter = new HttpFilter();

        return $filter->isSort($property);
    }
}

if (! function_exists('get_sort')) {
    /**
     * @param null|string $property
     *
     * @return string
     */
    function get_sort(?string $property): string
    {
        $filter = new HttpFilter();

        return $filter->getSort($property);
    }
}

if (! function_exists('get_filter')) {
    /**
     * @param string $property
     *
     * @return string|array|null
     */
    function get_filter(string $property)
    {
        $filter = new HttpFilter();

        return $filter->getFilter($property);
    }
}

if (! function_exists('get_filter_string')) {
    /**
     * @param string $property
     *
     * @return string
     */
    function get_filter_string(string $property): ?string
    {
        $filter = get_filter($property);
        
        if (is_array($filter) && (isset($filter['min']) || isset($filter['max']))) {
            $filter = ($filter['min'] ?? '') . ' - ' . ($filter['max'] ?? '');
        } elseif (is_array($filter) && (isset($filter['start']) || isset($filter['end']))) {
            $filter = ($filter['start'] ?? '') . ' - ' . ($filter['end'] ?? '');
        } elseif (is_array($filter)) {
            $filter = implode(', ', $filter);
        }
        
        return $filter;
    }
}

if (! function_exists('revert_sort')) {
    /**
     * @param string $property
     *
     * @return string
     */
    function revert_sort(string $property): string
    {
        $filter = new HttpFilter();

        return $filter->revertSort($property);
    }
}
