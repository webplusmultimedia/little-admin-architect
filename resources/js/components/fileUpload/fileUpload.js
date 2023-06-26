import {uuid} from "./support/file";
import {Danger, Info, Success, Warning} from "../notification/Notification";
import {gallery} from "./support/gallery";

/**
 *
 * @param state
 * @param {string} path
 * @param {null|int} minSize
 * @param {null|int} maxSize
 * @param {null|int} maxFiles
 * @param {Array} acceptedFileTypes
 * @param {boolean} multiple
 * @returns {{dropZone: {"@drop.prevent.stop"(): void, "@dragleave.prevent.stop"(): boolean, "@dragenter.prevent.stop"(): void}, init(): void, saveFileUsing(File[]), progress: number, state, overZone: {"@dragover.prevent.stop"(): void, "@dragleave.prevent.stop"(): boolean, "@dragenter.prevent.stop"(): void}, isProvidedMimeType(File): boolean, uploadUsing(*, *, *, *): void}|*|boolean}
 */
export function fileUpload({state, fieldName: path, minSize, maxSize, maxFiles, acceptedFileTypes, multiple}) {

    return {
        progress: 0,
        state,
        startUpload: false,
        photos: [],
        async uploadUsing(fileKey, file) {
            let newFile = this.getNewFile(file)

            this.addPhotosToView(newFile)
            await this.$wire.upload(`${path}`, file, (uploadedFilename) => {
                    Success('file ok : ' + uploadedFilename)
                    this.finishUploadUsing(newFile)

                    this.startUpload = false
                    this.reloadOnSave = true
                }
                ,
                () => {
                    this.startUpload = false
                    console.log('erreur de chargement')
                },
                (ev) => {
                    this.progress = ev.detail.progress
                })

        },
        addPhotosToView(newFile) {

            /*let endPhotos = Array.from(this.photos)
            endPhotos = endPhotos.pop() ?? false

            if (endPhotos && endPhotos.isInit) {
                endPhotos.isInit = true
                this.photos = [this.photos.map((photo) => photo.url === endPhotos.url ? endPhotos : photo), newFile]
                return
            }*/

            this.photos.push(newFile)
        },
        'dropZone': {
            ['@dragover.prevent.stop']() {

                if (this.$event.target.classList.contains('la-dropZone')) {

                }
            },
            async ['@drop.prevent.stop']() {
                if (this.$event.target.classList.contains('la-dropzone')) {
                    this.startUpload = true
                    await this.saveFileUsing(this.$event.dataTransfer.files)
                    this.$refs.dropzone.classList.remove('border-primary-500', 'text-primary-500')
                    this.$refs.ladroptitle.classList.remove('pointer-events-none')
                    this.$refs.ladroptitle.classList.add('pointer-events-auto')
                    this.startUpload = false
                }
            },
            ['@dragenter.prevent.stop']() {
                this.$refs.dropzone.classList.add('border-primary-500', 'text-primary-500')
                this.$refs.ladroptitle.classList.remove('pointer-events-auto')
                this.$refs.ladroptitle.classList.add('pointer-events-none')
            },
            ['@dragleave.prevent.stop']() {
                if (this.$event.target === this.$refs.dropzone) {
                    this.$refs.dropzone.classList.remove('border-primary-500', 'text-primary-500')
                }
                return false
            },
            ['@click.prevent.stop']() {
                this.$refs.laFileInput.click()
            }

        },
        'laFileInput': {
            async ['@change']() {
                const fileList = this.$event.target.files

                if (fileList.length) {
                    this.startUpload = true
                    await this.saveFileUsing(fileList)
                    this.startUpload = false
                }
            }
        },
        reloadOnSave: false,
        /** @param {File[]} files */
        async saveFileUsing(files) {
            for (const file of Array.from(files)) {

                if (!this.isFileSize(file) && !this.isProvidedMimeType(file)) {
                    setTimeout(() => {
                        Warning(`Le fichier ${file.name} ne peut être téléversé`)
                    }, 2)
                    continue;
                }

                await this.uploadUsing(uuid(), file);
            }
        },
        /**
         * @param {File} file
         * @returns {boolean}
         */
        isFileSize(file) {
            return file.size < maxSize
        },
        /**
         * @param {File} file
         * @returns {boolean}
         */
        isProvidedMimeType(file) {
            return acceptedFileTypes.find(type => type === file.type);
        },
        async deleteUploadFileUsing(key) {
            let isDelete = await this.$wire.deleteUploadFile(path, key)
            if (isDelete) {
                this.photos = this.photos.filter((val, index) => index !== key)
            }
        },

        async init() {
            this.$watch('state', async value => {

            });
            this.$watch('photos', value => {
                this.$refs.galleryImages.innerHTML = gallery(value, path).getGallery()
            });
            setTimeout(async () => {
                this.photos = await this.$wire.getUploadFileUrls(path) ?? []
            }, 50)

            window.addEventListener('little-admin-send-notification', async (ev) => {
                if (this.reloadOnSave) {
                    this.photos = await this.$wire.getUploadFileUrls(path) ?? []
                }
                this.reloadOnSave = false

                console.log('pass')
            })

        },
        finishUploadUsing(newFile) {
            let index = Array.from(this.photos).findIndex((file=> file === newFile))
            newFile.start = false
            this.photos[index] = newFile
            this.$refs.galleryImages.innerHTML = gallery(this.photos, path).getGallery()
        },
        getNewFile(file) {
            return {
                'url': URL.createObjectURL(file),
                'size': parseFloat(file.size / 1000) + 'Kb',
                'name': file.name,
                'new': true,
                'start': true,
                'isInit': false
            }
        }
    }
}
