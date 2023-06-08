
export function ModalTableComponent(id = null) {
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
                this.$wire.mountTableAction = null
                this.$wire.mountTableActionRecord = null
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
