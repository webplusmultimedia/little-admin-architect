import {uuid} from "./support/file";
import {Success} from "../notification/Notification";

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

                    console.log(this.$event.dataTransfer.files)
                    this.startUpload = true
                    await this.saveFileUsing(this.$event.dataTransfer.files)
                    this.$refs.dropzone.classList.remove('border-primary-500', 'text-primary-500')
                    //SaveFilesAction(ImageSupport().getDesireFiles(this.$event.dataTransfer.files), this.$data)
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
            Array.from(files).filter(async (file) => {
                if (this.isProvidedMimeType(file)) {
                    await this.uploadUsing(uuid(), file);
                }
            })
        },
        /**
         * @param {File} file
         * @returns {boolean}
         */
        isProvidedMimeType(file) {
            return acceptedFileTypes.find(type => type === file.type);
        },
        async init() {
            this.$watch('state', value => {
                console.log(value)
            });

            this.photos = await this.$wire.getUploadFileUrls(path) ?? []
              console.log(this.photos);
        }
    }
}
