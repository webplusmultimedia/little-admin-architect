import Alpine from 'alpinejs';
import {SelectFormComponent} from "./components/select/SelectFormComponent";
import {DropdownMenu} from "./components/menus/Dropdown/Dropdown";

Alpine.data('SelectFormComponent',SelectFormComponent)
Alpine.data('DropdownMenu',DropdownMenu)
window.Alpine = Alpine;



Alpine.start();
