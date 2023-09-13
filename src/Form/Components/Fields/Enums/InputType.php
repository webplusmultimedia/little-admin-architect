<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Enums;

enum InputType: string
{
    case Text = 'text';
    case Number = 'number';
    case Email = 'email';
    case Url = 'url';
    case Password = 'password';
    case Slug = 'slug';
    case Hidden = 'hidden';
}
