
export function fileUpload({state,fieldName, minSize, maxSize, maxFiles, acceptedFileTypes, multiple}) {

    return {
        progress : 0,
        state,
        uploadUsing(fileKey,file,error,progress){
            this.$wire.upload(`${fieldName}.${fileKey}`, file, () => {
                success(fileKey)
            }, error, progress)
        },
        'overZone': {
            ['@dragover.prevent.stop']() {

                if (this.$event.target.classList.contains('dropZone')) {

                }
            },
            ['@dragenter.prevent.stop']() {
                this.$refs.dropzone.classList.remove('pointer-events-none')
                this.$refs.dropzone.classList.add('border-primary-500 text-primary-500')
            },
            ['@dragleave.prevent.stop']() {
                if (this.$event.target === this.$refs.dropzone) {
                    this.$refs.dropzone.classList.remove('border-primary-500 text-primary-500')
                    this.$refs.dropzone.classList.add('pointer-events-none')
                }
                return false
            },
        },
        'dropZone': {
            ['@drop.prevent.stop']() {
                if (this.$event.target.classList.contains('la-dropZone')) {
                    this.$refs.dropzone.classList.remove('after:opacity-75', 'opacity-100', 'pointer-events-auto')
                    this.$refs.dropzone.classList.add('pointer-events-none')

                    //SaveFilesAction(ImageSupport().getDesireFiles(this.$event.dataTransfer.files), this.$data)
                }
            },
            ['@dragenter.prevent.stop']() {
                this.$refs.dropzone.classList.add('border-primary-500','text-primary-500')
            },
            ['@dragleave.prevent.stop']() {
                if (this.$event.target === this.$refs.dropzone) {
                    this.$refs.dropzone.classList.remove('border-primary-500','text-primary-500')
                }
                return false
            },
        },
        init(){
            console.log(state);
        }
    }
}
