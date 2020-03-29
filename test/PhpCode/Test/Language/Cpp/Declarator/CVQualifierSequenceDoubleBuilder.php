<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Language\Cpp\Declarator\CVQualifierSequence;
use PhpCode\Test\AbstractDoubleBuilder;

/**
 * Represents a builder of double for the {@see PhpCode\Language\Cpp\Declarator\CVQualifierSequence} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierSequenceDoubleBuilder extends AbstractDoubleBuilder
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return CVQualifierSequence::class;
    }
    
    /**
     * Builds a prophecy where getCVQualifiers() can be called.
     * 
     * @param   CVQualifier[]   $return The value to return when getCVQualifiers() is called.
     * @return  CVQualifierSequenceDoubleBuilder    This instance.
     */
    public function buildGetCVQualifiers(array $return): self
    {
        $this->getSubjectProphecy()
            ->getCVQualifiers()
            ->willReturn($return);
        
        return $this;
    }
}

