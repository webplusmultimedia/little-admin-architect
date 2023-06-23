import {uuid} from "./support/file";
import {Success, Warning} from "../notification/Notification";
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
            await this.$wire.upload(`${path}`, file, (uploadedFilename) => {
                    Success('file ok : ' + uploadedFilename)
                    this.photos.push({
                        'url': URL.createObjectURL(file),
                        'size' : parseFloat(file.size/1000) +'Kb',
                        'name' : file.name,
                        'new' : true
                    })
                    this.startUpload = false
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
                    this.startUpload = false
                }
            },
            ['@dragenter.prevent.stop']() {
                this.$refs.dropzone.classList.add('border-primary-500', 'text-primary-500')
            },
            ['@dragleave.prevent.stop']() {
                if (this.$event.target === this.$refs.dropzone) {
                    this.$refs.dropzone.classList.remove('border-primary-500', 'text-primary-500')
                }
                return false
            },

        },
        /** @param {File[]} files */
        async saveFileUsing(files) {
            Array.from(files).forEach(async (file) => {

                if (!this.isFileSize(file) && !this.isProvidedMimeType(file)) {
                    setTimeout(() => {
                        Warning(`Le fichier ${file.name} ne peut être téléversé`)
                    }, 2)
                    return;
                }

                await this.uploadUsing(uuid(), file);
            })
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
        async init() {
            this.$watch('state', async value => {

            });
            this.$watch('photos', value => {
                this.$refs.galleryImages.innerHTML = gallery(value).getGallery()
            });

            this.photos = await this.$wire.getUploadFileUrls(path) ?? []
        }
    }
}
