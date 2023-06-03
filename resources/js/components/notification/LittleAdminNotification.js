import {Danger, Info, Success, Warning} from "./Notification";

export function LittleAdminNotification() {
    return {
        init(){
            window.addEventListener('little-admin-send-notification',(ev)=>{
                let message = ev.detail.message
                let type = ev.detail.type
                switch (type) {
                    case 'danger' : Danger(message);break
                    case 'warning' : Warning(message);break
                    case 'info' : Info(message);break
                    default : Success(message)
                }
            })
        }
    }
}
