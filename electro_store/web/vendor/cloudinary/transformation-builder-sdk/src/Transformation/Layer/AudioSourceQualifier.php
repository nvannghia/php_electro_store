<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Transformation;

use Cloudinary\ClassUtils;

/**
 * Class AudioSourceQualifier
 */
class AudioSourceQualifier extends BaseSourceQualifier
{
    /**
     * @var string $sourceType The type of the layer.
     */
    protected $sourceType = 'audio';

    /**
     * AudioSourceQualifier constructor.
     *
     * @param $source
     */
    public function __construct($source)
    {
        parent::__construct();

        $this->audio($source);
    }

    /**
     * Sets the audio source.
     *
     * @param SourceValue|string $source The audio source.
     *
     * @return $this
     */
    public function audio($source)
    {
        $this->value->setValue(ClassUtils::verifyInstance($source, SourceValue::class));

        return $this;
    }
}
