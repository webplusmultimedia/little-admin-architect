
export function TableComponent(id) {
    return {
        id,
        nameEvent : id.livewireId + '.after.close',
        init(){
            window.addEventListener(this.nameEvent, ()=> {
                 this.$wire.render();
            })
        }
    }
}
