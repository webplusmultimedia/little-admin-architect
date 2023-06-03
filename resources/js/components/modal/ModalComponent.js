export default ModalComponent


function ModalComponent({name}) {


    return ({
        show: false,
        showActiveComponent: true,
        activeComponent: false,
        componentHistory: [],
        livewireTableId: null,
        setActiveModalComponent(id, livewireId = null, skip = false) {
            this.show = true;

            if (this.activeComponent !== id) {
                if (this.activeComponent !== false && skip === false) {
                    this.componentHistory.push({component: this.activeComponent, id: livewireId});
                }
                if (this.activeComponent === false) {
                    this.activeComponent = id
                    this.showActiveComponent = true;
                    this.livewireTableId = livewireId;
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
            this.$dispatch('close.modal')
        },
        removeModalToDom() {
            this.show = false
            this.$refs[this.activeComponent].remove()
            this.activeComponent = false
            this.livewireTableId = null
            this.$wire.components = []
            this.$wire.render()
        },
        init() {
            Livewire.on('adminShowModal', (id, livewireTableId) => {
                this.setActiveModalComponent(id, livewireTableId);
            });

            window.addEventListener('close.modal', () => {
                if (this.livewireTableId) {
                    this.$dispatch(this.livewireTableId + '.after.close')
                }
                setTimeout(() => this.removeModalToDom(),1)
            })
        }
    })
}

