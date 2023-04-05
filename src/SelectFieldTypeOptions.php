<?php namespace Anomaly\SelectFieldType;

use Anomaly\SelectFieldType\Command\ParseOptions;
use Illuminate\Contracts\Container\Container;

class SelectFieldTypeOptions
{
    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     */
    public function handle(SelectFieldType $fieldType, Container $container)
    {
        $options = array_get($fieldType->getConfig(), 'options', []);

        if (is_string($options)) {
            $options = dispatch_sync(new ParseOptions($fieldType, $options));
        }

        if ($options instanceof \Closure) {
            $options = $container->call($options, compact('fieldType'));
        }

        if (is_null($options)) {
            $options = [];
        }

        $fieldType->setOptions($options);
    }
}
