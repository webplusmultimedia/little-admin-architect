<?php



namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Mixins;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;
class SelectMixing
{
    public function getOptionsUsing(): Closure
    {
        return function (string $name){
            /**@var Form $form **/
            $form = $this->_form;
            if($form->hasOptionsUsing() and isset($form->getListOptionsUsing()[$name])){
                return call_user_func($form->getListOptionsUsing()[$name]);
            }
          return [];
        };
    }

    public function getSearchResultsUsing(): Closure
    {
        return function (string $name,string $search){
            /**@var Form $form **/
            $form = $this->_form;
            if($form->hasSearchResultsUsing() and isset($form->getSearchResultsUsing()[$name])){
                return call_user_func($form->getSearchResultsUsing()[$name],$search);
            }
            return [];
        };

    }
}
