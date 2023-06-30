<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class CreateAction extends Contrats\FormAction implements Htmlable
{

    public static function make(): CreateAction
    {
        return new self();
    }
    public function render(): View
    {
        return view('little-views::action.table-action',['action'=>$this]);
    }
    public function toHtml(): string
    {
       return $this->render()->render();
    }
}
