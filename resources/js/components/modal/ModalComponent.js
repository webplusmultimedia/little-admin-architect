export default  ModalComponent


function ModalComponent({name}) {


    return ({
        show: false,
        showActiveComponent: true,
        activeComponent: false,
        componentHistory: [],
        setActiveModalComponent(id, skip = false) {
            this.show = true;

            if (this.activeComponent !== id) {
                if (this.activeComponent !== false && skip === false) {
                    this.componentHistory.push(this.activeComponent);
                }
                if (this.activeComponent === false) {
                    this.activeComponent = id
                    this.showActiveComponent = true;
                } else {
                    this.showActiveComponent = false;
                    setTimeout(() => {
                        this.activeComponent = id;
                        this.showActiveComponent = true;
                    }, 300);
                }
            }
        },
        closeModal() {
            this.show = false
            Livewire.emit('close.modal')
        },
        removeModalToDom() {
            this.activeComponent = false
            this.show = false
            this.$wire.components = []
            this.$wire.render()
        },
        init() {
            Livewire.on('adminShowModal', (id) => {
                this.setActiveModalComponent(id);
            });

            Livewire.on('close.modal', () => {
                this.removeModalToDom()
            })
        }
    })
}

