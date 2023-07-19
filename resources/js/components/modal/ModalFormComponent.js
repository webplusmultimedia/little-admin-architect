
export function ModalFormComponent(id = null) {
    return {
        id ,
        eventId : null,
        isOpen : false,
        open(){

                this.isOpen = true
        },
        close(){
                this.isOpen = false
                this.$wire.mountFormAction = null
                this.$wire.mountFormActionComponent = null
                this.$wire.mountFormActionData = []
        },
        init(){
            window.addEventListener('show-modal',(ev)=>{
                this.eventId = ev.detail.id
                this.open()

            })

            window.addEventListener('close-modal',(ev)=>{
                this.eventId = ev.detail.id
                this.close()
            })
        }
    }
}
