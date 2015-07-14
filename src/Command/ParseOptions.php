<?php namespace Anomaly\SelectFieldType\Command;

use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class ParseOptions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\SelectFieldType\Command
 */
class ParseOptions implements SelfHandling
{

    /**
     * The string options.
     *
     * @var string
     */
    protected $options;

    /**
     * Create a new ParseOptions instance.
     *
     * @param $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @return array
     */
    public function handle()
    {
        $options = [];

        $group = null;

        foreach (explode("\n", $this->options) as $option) {

            // Find option [groups]
            if (starts_with($option, '[')) {

                $group = trans(substr(trim($option), 1, -1));

                $options[$group] = [];

                continue;
            }

            // Split on the first ":"
            $option = explode(':', $option, 2);

            $key   = ltrim(trim(array_shift($option)));
            $value = ltrim(trim($option ? array_shift($option) : $key));

            if ($group) {
                $options[$group][$key] = $value;
            } else {
                $options[$key] = $value;
            }
        }

        return $options;
    }
}
