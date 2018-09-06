<?php

/**
 * (c) Meritoo.pl, http://www.meritoo.pl
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meritoo\LimeSurvey\ApiClient\Exception;

use Meritoo\Common\Exception\Base\UnknownTypeException;
use Meritoo\LimeSurvey\ApiClient\Type\MethodType;

/**
 * An exception used while name of method used while talking to the LimeSurvey's API is unknown
 *
 * @author    Krzysztof Niziol <krzysztof.niziol@meritoo.pl>
 * @copyright Meritoo.pl
 */
class UnknownMethodException extends UnknownTypeException
{
    /**
     * Creates exception
     *
     * @param string $unknownMethod Name of unknown method used while talking to the LimeSurvey's API
     * @return UnknownMethodException
     */
    public static function createException($unknownMethod)
    {
        /* @var UnknownMethodException $exception */
        $exception = parent::create($unknownMethod, new MethodType(), 'name of method used while talking to the LimeSurvey\'s API');

        return $exception;
    }
}
