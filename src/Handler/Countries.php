<?php namespace Anomaly\SelectFieldType\Handler;

use Anomaly\SelectFieldType\SelectFieldType;
use Illuminate\Contracts\Config\Repository;

/**
 * Class Countries
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class Countries
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param Repository      $config
     */
    public function handle(SelectFieldType $fieldType, Repository $config)
    {
        $keys = array_keys($config->get('streams::countries.available'));

        $fieldType->setOptions(
            array_combine(
                $keys,
                array_map(
                    function ($key) {
                        return trans("streams::country.{$key}");
                    },
                    $keys
                )
            )
        );
    }
}
