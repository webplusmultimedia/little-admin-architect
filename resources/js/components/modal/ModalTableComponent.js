
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
            })
        }
    }
}
