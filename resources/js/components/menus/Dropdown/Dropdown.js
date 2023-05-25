export function DropdownMenu() {
    return{
        show : false,
        showMenu : {
            ['x-on:click.outside'](){
                this.show = false
            },
            ['x-show'](){
                return  this.show
            },
        }
    }
}
