import Alpine from 'alpinejs';
import {SelectFormComponent} from "./components/select/SelectFormComponent";
import {DropdownMenu} from "./components/menus/Dropdown/Dropdown";
import ModalComponent from "./components/modal/ModalComponent";

Alpine.data('SelectFormComponent',SelectFormComponent)
Alpine.data('DropdownMenu',DropdownMenu)
Alpine.data('ModalComponent',ModalComponent)
window.Alpine = Alpine;



Alpine.start();
