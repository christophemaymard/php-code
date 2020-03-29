<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Language\Cpp\Declarator;

use PhpCode\Language\Cpp\Declarator\CVQualifier;
use PhpCode\Test\AbstractDoubleFactory;

/**
 * Represents a factory of doubles for the {@see PhpCode\Language\Cpp\Declarator\CVQualifier} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class CVQualifierDoubleFactory extends AbstractDoubleFactory
{
    /**
     * {@inheritDoc}
     */
    protected function getSubjectName(): string
    {
        return CVQualifier::class;
    }
    
    /**
     * Creates a double of a constant/volatile qualifier defined as constant.
     * 
     * @return  CVQualifier
     */
    public function createConstant(): CVQualifier
    {
        return $this->createCVQualifier(TRUE, FALSE);
    }
    
    /**
     * Creates a double of a constant/volatile qualifier defined as volatile.
     * 
     * @return  CVQualifier
     */
    public function createVolatile(): CVQualifier
    {
        return $this->createCVQualifier(FALSE, TRUE);
    }
    
    /**
     * Creates a double where isConst() and isVolatile() can be called.
     * 
     * @param   bool    $constant   The value to return when isConst() is called.
     * @param   bool    $volatile   The value to return when isVolatile() is called.
     * @return  CVQualifier
     */
    private function createCVQualifier(bool $constant, bool $volatile): CVQualifier
    {
        $prophecy = $this->prophesizeSubject();
        $prophecy
            ->isConst()
            ->willReturn($constant);
        $prophecy
            ->isVolatile()
            ->willReturn($volatile);
        
        return $prophecy->reveal();
    }
}

