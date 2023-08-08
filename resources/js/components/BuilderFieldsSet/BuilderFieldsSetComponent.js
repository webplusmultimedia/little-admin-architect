export function BuilderFieldsSetComponent(path) {
    return {
        path,
        init(){
            let sort = Sortable.create(this.$refs.laBuilderFieldSet, {
                handle: '.la-icon-grip',
                ghostClass: 'opacity-50',
                animation: 180,
                onEnd: async (evt) => {
                    if (evt.oldIndex !== evt.newIndex) {
                        this.$wire.call('callAction',path,'reorderFieldToFieldSet',[sort.toArray()])
                    }
                }
            })
        }
    }
}
