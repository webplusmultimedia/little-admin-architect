import Alpine from 'alpinejs';
import {SelectFormComponent} from "./components/select/SelectFormComponent";
import {DropdownMenu} from "./components/menus/Dropdown/Dropdown";
import ModalComponent from "./components/modal/ModalComponent";
import {TableComponent} from "./components/table/TableComponent";
import {LittleAdminNotification} from "./components/notification/LittleAdminNotification";
import {ModalTableComponent} from "./components/modal/ModalTableComponent";

import {webplusDateTime} from "./components/DateTime/dateTime";
import time from "./components/DateTime/time";
import {listeDate} from "./components/DateTime/listeDate";
import {btnUpDownDate} from "./components/DateTime/btnUpDownDate";
import timePicker from "./components/DateTime/timePicker";

Alpine.data('SelectFormComponent',SelectFormComponent)
Alpine.data('DropdownMenu',DropdownMenu)
Alpine.data('ModalComponent',ModalComponent)
Alpine.data('ModalTableComponent',ModalTableComponent)
Alpine.data('TableComponent',TableComponent)
Alpine.data('LittleAdminNotification',LittleAdminNotification)
Alpine.data('webplusDateTime', webplusDateTime)
Alpine.data('listeDate', listeDate)
Alpine.data('time', time)
Alpine.data('btnUpDownDate', btnUpDownDate)
Alpine.data('timePicker', timePicker)

window.Alpine = Alpine;



Alpine.start();
