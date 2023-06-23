
export function gallery(files) {
    return{
        extensions : ['png','jpg','jpeg','svg'],
        /** @param {Array} file */
        template (file){
            let extension = file['url'].split('.').pop(),
                url = file['url']
            if(!this.extensions.find(ext => ext === extension)){

            }
            return `<div class="la-file-upload-image-wrapper">
                        <img src="${url}" alt="image" class="object-cover w-full">

                        <div
                        x-bind:class="{
                            'la-file-upload-image-infos' : true,
                            'la-file-upload-image-infos-gradient-new' : ${(!!file['new'])},
                            'la-file-upload-image-infos-gradient' : ${(!file['new'])},

                        }"
                        >
                            <div class="text-[0.795rem] text-white truncate">${file['name']}</div>
                            <div class="text-[0.795rem] text-white">${file['size']}</div>
                        </div>
                    </div>`
        },
        getGallery(){
            let res = '';
            files.forEach(file=> res += this.template(file))

            return  res
        }
    }
}
