
export function ModalFormComponent(id = null) {
    return {
        id : null,
        isOpen : false,
        open(){
            if (this.id === id) {
                this.isOpen = true
            }
        },
        close(){
            if (this.id === id) {
                this.isOpen = false
                this.$wire.mountFormAction = null
                this.$wire.mountFormActionRecord = null
                this.$wire.mountFormActionData = null
            }
        },
        init(){
            window.addEventListener('show-modal',(ev)=>{
                this.id = ev.detail.id
                this.open()

            })

            window.addEventListener('close-modal',(ev)=>{
                this.id = ev.detail.id
                this.close()
                console.log(ev.detail)
            })
        }
    }
}
