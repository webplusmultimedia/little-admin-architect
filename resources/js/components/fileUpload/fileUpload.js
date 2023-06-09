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
        path,
        startUpload: false,
        stopDragging : false,
        photos: [],
        async uploadUsing(fileKey, file) {
            let newFile = this.getNewFile(file)
            newFile['id'] = fileKey
            this.photos.push(newFile)
            this.$store.laDatas.startUploadFile = true
            this.stopDragging = true

            await this.$wire.upload(`${this.path}`, file, (uploadedFilename) => {
                    Success('file ok : ' + uploadedFilename)
                    this.finishUploadUsing(newFile,uploadedFilename)

                    this.startUpload = false
                    this.reloadOnSave = true
                    this.$store.laDatas.startUploadFile = false
                }
                ,
                () => {
                    this.startUpload = false
                    this.$store.laDatas.startUploadFile = false
                    this.reloadOnSave = true
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
            let isDelete = await this.$wire.deleteUploadFile(this.path, key)

            if (isDelete) {
                this.photos = this.photos.filter((val) => val['id'] !== key)
            }
        },

        async init() {
            this.$watch('photos', value => {
                this.$refs.galleryImages.innerHTML = gallery(value, this.path).getGallery()
            });
            setTimeout(async () => {
                this.photos = await this.$wire.getUploadFileUrls(this.path) ?? []
            }, 50)

            window.addEventListener('little-admin-send-notification', async (ev) => {
                if (this.reloadOnSave) {
                    this.stopDragging = false
                    this.photos = await this.$wire.getUploadFileUrls(this.path) ?? []
                }
                this.reloadOnSave = false
            })
            let sort = Sortable.create(this.$refs.galleryImages, {
                handle: '.la-icon-grip',
                ghostClass: 'opacity-50',
                animation: 180,
                onEnd: async (evt) => {
                    if(evt.oldIndex !== evt.newIndex) {
                        this.reorderFiles(sort.toArray())
                    }
                }
            })

        },
        async reorderFiles(newOrder){
            if (!this.stopDragging) {
                this.photos = await this.$wire.reorderUploadFiles(this.path, newOrder)
                return
            }
            this.$refs.galleryImages.innerHTML = gallery(this.photos, this.path).getGallery()
        },
        finishUploadUsing(newFile,newName) {
            try {
                /**
                 *
                 * @type {Object}
                 */
                const endState = Array.from(this.state).pop(),
                    key =  Object.keys(endState)[0],
                    name =    endState[key].split('livewire-file:').pop()
                if(name === newName){
                    newFile['id'] = key
                }

                let index = Array.from(this.photos).findIndex((file=> file === newFile))
                newFile.start = false
                this.photos[index] = newFile
                this.$refs.galleryImages.innerHTML = gallery(this.photos, this.path).getGallery()
            } catch (e) {
                //console.log(e)
            }
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
