
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
        },
        init(){
            window.addEventListener('show-modal',(ev)=>{
                this.eventId = ev.detail.id
                if (ev.detail.id === this.id) {
                    this.open()
                }

            })

            window.addEventListener('close-modal',(ev)=>{
                if (ev.detail.id === this.id) {
                    this.close()
                    this.$wire.mountFormActionData = []
                    this.$wire.mountFormActionComponent = null
                    this.$wire.mountFormAction = null
                    this.$wire.mountFormActionComponentArguments = []
                }
            })
        }
    }
}
