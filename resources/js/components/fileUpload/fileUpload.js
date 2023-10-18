import {uuid} from "./support/helpers";
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
 * @param {boolean} enableCustomProperties
 * @param {boolean} isReordable
 * @returns {{dropZone: {"@drop.prevent.stop"(): void, "@dragleave.prevent.stop"(): boolean, "@dragenter.prevent.stop"(): void}, init(): void, saveFileUsing(File[]), progress: number, state, overZone: {"@dragover.prevent.stop"(): void, "@dragleave.prevent.stop"(): boolean, "@dragenter.prevent.stop"(): void}, isProvidedMimeType(File): boolean, uploadUsing(*, *, *, *): void}|*|boolean}
 */
export function fileUpload({state, fieldName: path, minSize, maxSize, maxFiles, acceptedFileTypes, multiple, enableCustomProperties,isReordable}) {

    return {
        progress: 0,
        state,
        path,
        maxFiles,
        isMultiple: multiple,
        startUpload: false,
        stopDragging: !isReordable,
        enableCustomProperties,
        isReordable,
        mountFormAction(id) {
            this.$wire.call('mountFormAction', `${this.path}`, 'editCustomProperties',[id])
        },
        isEnableCustomProperties() {
            return this.enableCustomProperties
        },
        photos: [],
        async uploadUsing(fileKey, file) {
            let newFile = this.getNewFile(file)
            newFile['id'] = fileKey
            this.photos.push(newFile)
            this.$store.laDatas.startUploadFile = true
            if (this.isReordable) {
                this.stopDragging = true
            }

            await this.$wire.upload(`${this.path}`, file, (uploadedFilename) => {
                    Success('file ok : ' + uploadedFilename)
                    this.finishUploadUsing(newFile, uploadedFilename)

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
            if (!this.canUploadAll(files.length)) {
                Warning(`Le nombre limite de fichier (${this.maxFiles}) a été atteint.<br>Il ne vous reste que ${(this.maxFiles - this.photos.length)} fichier(s) à télécharger.`)
                return
            }
            for (const file of Array.from(files)) {
                if (!this.isFileSize(file) || !this.isProvidedMimeType(file) || !this.canUpload()) {
                    setTimeout(() => {
                        Warning(`Le fichier ${file.name} ne peut être téléversé`)
                    }, 2)
                    continue;
                }

                await this.uploadUsing(uuid(), file);
            }
        },
        canUploadAll(fileCount) {
            if (this.isMultiple && this.maxFiles) {
                return (this.photos.length + fileCount) <= this.maxFiles
            }
            return true
        },
        /**
         * @param {File} file
         * @returns {boolean}
         */
        isFileSize(file) {
            return Math.round(file.size / 1000) < maxSize
        },
        /**
         * @param {File} file
         * @returns {boolean}
         */
        isProvidedMimeType(file) {
            console.log(file.type)
            return acceptedFileTypes.find(type => type === file.type);
        },
        canUpload() {

            if (!this.isMultiple) {
                return this.photos.length < 1
            }

            if (this.maxFiles) {
                return this.photos.length < this.maxFiles
            }

            return true
        },
        async deleteUploadFileUsing(key) {
            let isDelete = await this.$wire.call('callAction',this.path,'deleteUploadFileUsing', [key],true)

            if (isDelete) {
                this.photos = this.photos.filter((val) => val['id'] !== key)
            }
        },

        async init() {
            this.$watch('photos', photos => {
                this.$refs.galleryImages.innerHTML = gallery(photos, this.path).getGallery()
            });
            setTimeout(async () => {
                await this.refreshPhotos()
            }, 50)

            window.addEventListener(`${this.path}.save_event`, async (ev) => {
                    this.stopDragging = !this.isReordable
                    this.photos = await this.$wire.call('callAction',this.path,'getUploadFileUrlsUsing',[],true) ?? []
                this.reloadOnSave = false
            })
            let sort = Sortable.create(this.$refs.galleryImages, {
                handle: '.la-icon-grip',
                ghostClass: 'opacity-50',
                animation: 180,
                onEnd: async (evt) => {
                    if (evt.oldIndex !== evt.newIndex) {
                        this.reorderFiles(sort.toArray())
                    }
                }
            })

        },
        async refreshPhotos(reorder = false, newOrder=null) {
            let photos;
            if (reorder) {
                photos = await this.$wire.call('callAction',this.path,'reorder', [newOrder])
            } else {
                 photos = await this.$wire.call('callAction',this.path,'getUploadFileUrlsUsing',[],true) ?? []
            }
            let tmpFiles = Array.from(this.photos).filter(photo => photo['new'])
            this.photos = photos.concat(tmpFiles)
        },
        async reorderFiles(newOrder) {
            if (!this.stopDragging) {
                await this.refreshPhotos(true, newOrder)
                //this.photos = await this.$wire.getUploadFileUrls(this.path) ?? []
                return
            }
            this.$refs.galleryImages.innerHTML = gallery(this.photos, this.path).getGallery()
        },
        finishUploadUsing(newFile, newName) {
            try {
                /**
                 *
                 * @type {Object}
                 */
                const endState = Array.from(this.state).pop(),
                    key = Object.keys(endState)[0],
                    name = endState[key].split('livewire-file:').pop()
                if (name === newName) {
                    newFile['id'] = key
                }

                let index = Array.from(this.photos).findIndex((file => file === newFile))
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
