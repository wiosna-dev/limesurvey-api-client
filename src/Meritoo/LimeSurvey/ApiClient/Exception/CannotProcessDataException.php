<?php

/**
 * (c) Meritoo.pl, http://www.meritoo.pl
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meritoo\LimeSurvey\ApiClient\Exception;

/**
 * An exception used while raw data returned by the LimeSurvey's API cannot be processed
 *
 * @author    Krzysztof Niziol <krzysztof.niziol@meritoo.pl>
 * @copyright Meritoo.pl
 */
class CannotProcessDataException extends \Exception
{
    /**
     * Class constructor
     *
     * @param string $reason Reason why data cannot be processed, e.g. "Invalid user name or password"
     */
    public function __construct($reason)
    {
        $template = 'Raw data returned by the LimeSurvey\'s API cannot be processed. Reason: \'%s\'.';
        $message = sprintf($template, $reason);

        parent::__construct($message);
    }
}
