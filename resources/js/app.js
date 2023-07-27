import Alpine from 'alpinejs';
import AlpineFloatingUI from "@awcodes/alpine-floating-ui";
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
import {fileUpload} from "./components/fileUpload/fileUpload";
import {laImageGalleryComponent} from "./components/fileUpload/support/gallery";
import {buttonActionComponent} from "./components/buttons/action";
import Sortable from 'sortablejs';
import {ModalFormComponent} from "./components/modal/ModalFormComponent";

window.Sortable = Sortable

Alpine.data('SelectFormComponent',SelectFormComponent)
Alpine.data('DropdownMenu',DropdownMenu)
Alpine.data('ModalComponent',ModalComponent)
Alpine.data('ModalTableComponent',ModalTableComponent)
Alpine.data('ModalFormComponent',ModalFormComponent)
Alpine.data('TableComponent',TableComponent)
Alpine.data('LittleAdminNotification',LittleAdminNotification)
Alpine.data('webplusDateTime', webplusDateTime)
Alpine.data('listeDate', listeDate)
Alpine.data('time', time)
Alpine.data('btnUpDownDate', btnUpDownDate)
Alpine.data('timePicker', timePicker)
Alpine.data('fileUpload',fileUpload)
Alpine.data('laImageGalleryComponent',laImageGalleryComponent)
Alpine.data('buttonActionComponent',buttonActionComponent)
document.addEventListener('alpine:init', () => {
    Alpine.store('laDatas', {
        isTinyEditorShow: false,
        startUploadFile: false,
        isMobileMenuShow : false,
        menuOpen: localStorage.getItem('isMenuOpen')===null ? false: localStorage.getItem('isMenuOpen').toLocaleLowerCase() === 'true',
        toggleMenu() {
            this.menuOpen = !this.menuOpen
            localStorage.setItem('isMenuOpen', this.menuOpen)
        },
        toggleMobileMenu(){
            this.isMobileMenuShow = ! this.isMobileMenuShow
            console.log(this.isMobileMenuShow)
        }
    })
})

//Alpine.plugin(focus)
Alpine.plugin(AlpineFloatingUI);

window.Alpine = Alpine;



Alpine.start();
