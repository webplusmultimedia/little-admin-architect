<?php

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait HasExtrasAttributes
{
    protected string $extraAttributes= 'primary';


    public function extraAttributes(string $extraAttributes): HasExtrasAttributes
    {
        $this->extraAttributes = $extraAttributes;

        return $this;
    }


}
