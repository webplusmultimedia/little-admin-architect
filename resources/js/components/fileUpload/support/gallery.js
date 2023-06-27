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
                        data-id="${key}"
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
                        <div class="absolute bottom-0 right-0 px-2 py-2 la-icon-grip"
                            :class="{ 'hidden' : stopDragging }"
                        >
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white w-5 h-5 cursor-grab">
<path fill-rule="evenodd" clip-rule="evenodd" d="M2 0C2.53043 0 3.03914 0.210714 3.41421 0.585786C3.78929 0.960859 4 1.46957 4 2C4 2.53043 3.78929 3.03914 3.41421 3.41421C3.03914 3.78929 2.53043 4 2 4C1.46957 4 0.960859 3.78929 0.585786 3.41421C0.210714 3.03914 0 2.53043 0 2C0 1.46957 0.210714 0.960859 0.585786 0.585786C0.960859 0.210714 1.46957 0 2 0ZM10 0C10.5304 0 11.0391 0.210714 11.4142 0.585786C11.7893 0.960859 12 1.46957 12 2C12 2.53043 11.7893 3.03914 11.4142 3.41421C11.0391 3.78929 10.5304 4 10 4C9.46957 4 8.96086 3.78929 8.58579 3.41421C8.21071 3.03914 8 2.53043 8 2C8 1.46957 8.21071 0.960859 8.58579 0.585786C8.96086 0.210714 9.46957 0 10 0ZM20 2C20 1.46957 19.7893 0.960859 19.4142 0.585786C19.0391 0.210714 18.5304 0 18 0C17.4696 0 16.9609 0.210714 16.5858 0.585786C16.2107 0.960859 16 1.46957 16 2C16 2.53043 16.2107 3.03914 16.5858 3.41421C16.9609 3.78929 17.4696 4 18 4C18.5304 4 19.0391 3.78929 19.4142 3.41421C19.7893 3.03914 20 2.53043 20 2ZM2 8C2.53043 8 3.03914 8.21071 3.41421 8.58579C3.78929 8.96086 4 9.46957 4 10C4 10.5304 3.78929 11.0391 3.41421 11.4142C3.03914 11.7893 2.53043 12 2 12C1.46957 12 0.960859 11.7893 0.585786 11.4142C0.210714 11.0391 0 10.5304 0 10C0 9.46957 0.210714 8.96086 0.585786 8.58579C0.960859 8.21071 1.46957 8 2 8ZM12 10C12 9.46957 11.7893 8.96086 11.4142 8.58579C11.0391 8.21071 10.5304 8 10 8C9.46957 8 8.96086 8.21071 8.58579 8.58579C8.21071 8.96086 8 9.46957 8 10C8 10.5304 8.21071 11.0391 8.58579 11.4142C8.96086 11.7893 9.46957 12 10 12C10.5304 12 11.0391 11.7893 11.4142 11.4142C11.7893 11.0391 12 10.5304 12 10ZM18 8C18.5304 8 19.0391 8.21071 19.4142 8.58579C19.7893 8.96086 20 9.46957 20 10C20 10.5304 19.7893 11.0391 19.4142 11.4142C19.0391 11.7893 18.5304 12 18 12C17.4696 12 16.9609 11.7893 16.5858 11.4142C16.2107 11.0391 16 10.5304 16 10C16 9.46957 16.2107 8.96086 16.5858 8.58579C16.9609 8.21071 17.4696 8 18 8ZM4 18C4 17.4696 3.78929 16.9609 3.41421 16.5858C3.03914 16.2107 2.53043 16 2 16C1.46957 16 0.960859 16.2107 0.585786 16.5858C0.210714 16.9609 0 17.4696 0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20C2.53043 20 3.03914 19.7893 3.41421 19.4142C3.78929 19.0391 4 18.5304 4 18ZM10 16C10.5304 16 11.0391 16.2107 11.4142 16.5858C11.7893 16.9609 12 17.4696 12 18C12 18.5304 11.7893 19.0391 11.4142 19.4142C11.0391 19.7893 10.5304 20 10 20C9.46957 20 8.96086 19.7893 8.58579 19.4142C8.21071 19.0391 8 18.5304 8 18C8 17.4696 8.21071 16.9609 8.58579 16.5858C8.96086 16.2107 9.46957 16 10 16ZM20 18C20 17.4696 19.7893 16.9609 19.4142 16.5858C19.0391 16.2107 18.5304 16 18 16C17.4696 16 16.9609 16.2107 16.5858 16.5858C16.2107 16.9609 16 17.4696 16 18C16 18.5304 16.2107 19.0391 16.5858 19.4142C16.9609 19.7893 17.4696 20 18 20C18.5304 20 19.0391 19.7893 19.4142 19.4142C19.7893 19.0391 20 18.5304 20 18Z" fill="currentColor"/>
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

export function laImageGalleryComponent({startUpload, newImg, isInit}) {
    return {
        newImg,
        startUpload,
        isInit,

        init() {
            if (!this.isInit && this.startUpload) {
                this.$refs.la_file_upload_image_wrapper.classList.add('animate-pulse');
            }

        }
    }
}
