export function gallery(files) {
    return {
        extensions: ['png', 'jpg', 'jpeg', 'svg'],
        /**
         * @param {Array} file
         * @param {int} key
         * */
        template(file, key) {
            let extension = file['name'].split('.').pop(),
                url = file['url']

            if (!this.extensions.find(ext => ext === extension)) {

            }
            return `<div class="la-file-upload-image-wrapper"
                        x-data="laImageGalleryComponent({ startUpload : ${!!file['start']}, newImg : ${!!file['new']}, isInit : ${!!file['isInit']} })"
                        x-ref="la_file_upload_image_wrapper"
                    >
                        <img src="${url}" alt="image" class="object-cover w-full">

                        <div
                        x-bind:class="{
                            'la-file-upload-image-infos' : true,
                            'la-file-upload-image-infos-gradient-new' : ${(!!file['new'])},
                            'la-file-upload-image-infos-gradient' : ${(!file['new'])},
                        }"
                        >
                            <div class="max-w-[80%] select-none">
                                <div class="text-[0.795rem] text-white truncate">${file['name']}</div>
                                <div class="text-[0.795rem] text-white">${file['size']}</div>
                            </div>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                 class="animate-spin  w-6 h-6 text-white"
                                 x-show="startUpload"
                            >
                                <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"></path>
                                <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                            </svg>

                           <svg xmlns="http://www.w3.org/2000/svg"
                               class="w-6 h-6 text-white hover:text-error-500 transition cursor-pointer"
                               x-show="!startUpload"
                                x-on:click.prevent.stop="deleteUploadFileUsing('${file['id']}')"
                               fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                           >
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                            </svg>
                        </div>
                    </div>`
        },
        getGallery() {
            //console.log(files)
            let res = '';
            files.forEach((file, key) => res += this.template(file, key))

            return res
        }
    }
}

export function laImageGalleryComponent({startUpload,newImg,  isInit}) {
    return {
        newImg,
        startUpload,
        isInit,
        init() {
            if (!this.isInit && this.startUpload) {
                this.$refs.la_file_upload_image_wrapper.classList.add('animate-pulse');
                 //console.log(this.$refs.la_file_upload_image_wrapper)
                /*setInterval(() => {

                    //$this.$refs.la_file_upload_image_wrapper.style.opacity = 1
                }, 10);*/
                //this.isInit = true
            }
        }
    }
}
