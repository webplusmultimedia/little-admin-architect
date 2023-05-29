import Alpine from 'alpinejs';
import {SelectFormComponent} from "./components/select/SelectFormComponent";
import {DropdownMenu} from "./components/menus/Dropdown/Dropdown";
import ModalComponent from "./components/modal/ModalComponent";
import {TableComponent} from "./components/table/TableComponent";

Alpine.data('SelectFormComponent',SelectFormComponent)
Alpine.data('DropdownMenu',DropdownMenu)
Alpine.data('ModalComponent',ModalComponent)
Alpine.data('TableComponent',TableComponent)
window.Alpine = Alpine;



Alpine.start();
