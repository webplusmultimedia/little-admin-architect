import {OptionsBuilder, TagsBuilder} from "./OptionsBuilder";

export function SelectFormComponent({
                                        componentId,
                                        defaultLabel,
                                        state,
                                        defaultValue,
                                        isMultiple,
                                        isSearchable,
                                        optionsUsing,
                                        hasOptionUsing,
                                        msgContent,
                                        searchDebounce,
                                        isDynamicOptions
                                    }) {

    return {
        show: false,
        selectedOptions: {label: null, value: null},
        optionsBackup: null,
        options: optionsUsing,
        isSearching: false,
        search: null,
        defaultLabel,
        defaultMultipleLabel: optionsUsing,
        componentId,
        state,
        defaultValue,
        isMultiple,
        isSearchable,
        hasOptionUsing,
        msgContent,
        isDynamicOptions,
        dynamicOptions: [],
        searchDebounce,
        canShowNoResult: false,
        async getOptionUsing() {
            this.options = await this.$wire.getOptionUsing(componentId)
            this.options.push(this.selectedOptions)
            this.$refs.list_options.innerHTML = OptionsBuilder(this.options)
        },
        async getResultsOnSearchTerm(term) {
            if (!this.hasOptionUsing) {
                this.options = await this.$wire.getSearchResultUsing(componentId, term)
                this.addSelectedOptionToNewList()
                if (this.isDynamicOptions) {  //For belongToMany
                    this.state = [...this.dynamicOptions]
                }
            }
            if (this.hasOptionUsing) {
                this.options = this.searchInOptions(term)
                this.$refs.list_options.innerHTML = OptionsBuilder(this.options)
            }

        },
        searchInOptions(term) {
            return this.options.filter(option => option.label.toLowerCase().match(new RegExp(term.toLowerCase(), 'g')))
        },
        selectOptionFrom(item) {
            if (item && !this.isMultiple) {
                this.selectedOptions = item
            } else if (item && this.isMultiple) {
                let isDuplicateTag = Array.from(this.defaultMultipleLabel).filter(option => String(option.value) === String(item.value)).length
                if (!isDuplicateTag) {
                    this.defaultMultipleLabel.push(item)
                    this.defaultLabel = TagsBuilder(this.defaultMultipleLabel)

                    if (this.isDynamicOptions) {  //For belongToMany
                        this.dynamicOptions.push(this.$el.dataset.value)
                        this.state = [...this.dynamicOptions]
                    } else {
                        if (!this.state) {
                            this.state = []
                        }
                        this.state.push(this.$el.dataset.value)
                    }
                }
            }

        },
        addSelectedOptionToNewList() {
            if (!this.isMultiple && this.selectedOptions.value) {
                if (!Array.from(this.options).filter(option => (option.label === this.selectedOptions.label) && (option.value === this.selectedOptions.value)).length) {
                    this.options.push(this.selectedOptions)
                }
            }
            this.$refs.list_options.innerHTML = OptionsBuilder(this.options)
        },
        search_terms: {
            ['x-on:keyup.esc']() {
                this.show = false
            },
            async ['x-on:keyup.debounce.800ms']() {
                let key = this.$event.key
                /** @todo need to remove specials keys causing a (re)search */
                this.canShowNoResult = false
                let term = this.$refs.search.value
                if (!this.isSearching && term !== '') {
                    if (!this.optionsBackup && this.hasOptionUsing) {
                        this.optionsBackup = this.options
                    }
                    this.isSearching = true
                    await this.getResultsOnSearchTerm(term)
                    this.canShowNoResult = true;
                    this.isSearching = false

                } else if (this.hasOptionUsing && this.optionsBackup) {
                    this.options = this.optionsBackup
                    this.$refs.list_options.innerHTML = OptionsBuilder(this.options)
                }
            }
        },
        showNoResult() {
            if (this.canShowNoResult) {
                return this.options.length === 0
            }
            return this.canShowNoResult
        },
        selectItem: {
            ['x-on:click.stop']() {
                if (!this.isMultiple) {
                    this.selectOptionFrom({label: this.$el.dataset.label, value: this.$el.dataset.value})
                    this.defaultLabel = this.$el.dataset.label
                    this.state = this.$el.dataset.value
                    this.show = false
                } else {
                    this.selectOptionFrom({label: this.$el.dataset.label, value: this.$el.dataset.value})

                    /**@todo Tags */
                }

                this.$refs.search.focus()
            }
        },
        resetOptions() {
            if (!this.isMultiple) {
                this.selectedOptions = {label: null, value: null}
                this.state = null
            } else {
                this.defaultMultipleLabel = []
                if (this.isDynamicOptions) {  //For belongToMany
                    this.dynamicOptions = []
                    this.state = []
                } else {
                    this.state = []
                }
            }
            this.defaultLabel = null

            this.$refs.search.focus()
        },
        setUp() {
            if (this.isMultiple) {
                this.defaultLabel = TagsBuilder(this.defaultMultipleLabel)
                if (!this.state) {
                    this.state = []
                }
                if (this.isDynamicOptions) {
                    this.dynamicOptions = [...this.defaultValue]
                    this.state = this.dynamicOptions
                }
            } else {
                this.selectOptionFrom({label: defaultLabel, value: defaultValue})
            }
        },
        init() {
            this.setUp()
            this.$nextTick(() => this.addSelectedOptionToNewList())
            this.$watch('show', (value) => {
                if (value) {
                    setTimeout(() => {
                        this.$refs.search.focus()
                    }, 5)
                }
            })

            window.addEventListener(`${componentId}.getLabel_event`, ev => {
                if (this.isMultiple) {
                    this.defaultMultipleLabel = ev.detail
                    this.defaultLabel = TagsBuilder(this.defaultMultipleLabel)

                    if (this.isDynamicOptions) {
                        this.dynamicOptions = this.state
                    }
                } else {
                    this.defaultValue = this.state
                    this.defaultLabel = ev.detail
                    this.selectOptionFrom({label: this.defaultLabel, value: this.defaultValue})
                }
            })

            Livewire.on(`${componentId}.clear_event`, value => {
                this.resetOptions()
            })
        },
        showChoiceSelected() {
            if (!this.isMultiple) {
                return this.selectedOptions.value
            } else {
                return this.defaultMultipleLabel.length > 0
            }
        },
        deleteTag: {
            ['x-on:click.stop']() {
                let id = this.$refs.tagElement.dataset.value
                if (this.isDynamicOptions) {  //For belongToMany
                    this.dynamicOptions = Array.from(this.dynamicOptions).filter(idState => {
                        return String(idState) !== String(id)
                    })
                    this.state = [...this.dynamicOptions]
                } else {
                    this.state = Array.from(this.state).filter(idState => idState !== id)
                }
                this.defaultMultipleLabel = Array.from(this.defaultMultipleLabel).filter(label => String(label.value) !== id)
                this.defaultLabel = TagsBuilder(this.defaultMultipleLabel)
                /** @Todo add the remove tag to list options */
            },
        }

    }
}
