export function buttonActionComponent() {
    return {
        form: null,
        isUploadingFile: false,
        triggerFileUpload : {
          [':disabled'](){
              return this.isUploadingFile
          }
        },
        init() {

        }
    }
}

