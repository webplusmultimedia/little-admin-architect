import Alpine from 'alpinejs';
import {SelectFormComponent} from "./components/select/SelectFormComponent";
import {DropdownMenu} from "./components/menus/Dropdown/Dropdown";
import ModalComponent from "./components/modal/ModalComponent";
import {TableComponent} from "./components/table/TableComponent";
import {LittleAdminNotification} from "./components/notification/LittleAdminNotification";
import {ModalTableComponent} from "./components/modal/ModalTableComponent";

Alpine.data('SelectFormComponent',SelectFormComponent)
Alpine.data('DropdownMenu',DropdownMenu)
Alpine.data('ModalComponent',ModalComponent)
Alpine.data('ModalTableComponent',ModalTableComponent)
Alpine.data('TableComponent',TableComponent)
Alpine.data('LittleAdminNotification',LittleAdminNotification)
window.Alpine = Alpine;



Alpine.start();
