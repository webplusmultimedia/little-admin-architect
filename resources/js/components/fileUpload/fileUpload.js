
export function fileUpload({state,fieldName, minSize, maxSize, maxFiles, acceptedFileTypes, multiple}) {

    return {
        progress : 0,
        state,
        uploadUsing(fileKey,file,error,progress){
            this.$wire.upload(`${fieldName}.${fileKey}`, file, () => {
                success(fileKey)
            }, error, progress)
        },
        init(){
            console.log(state);
        }
    }
}
