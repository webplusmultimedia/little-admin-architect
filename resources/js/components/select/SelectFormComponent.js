import {OptionsBuilder, TagsBuilder} from "./OptionsBuilder";

export function SelectFormComponent(componentId, defaultLabel, state, defaultValue, isMultiple,isSearchable,optionsUsing, hasOptionUsing, msgContent, searchDebounce) {

    return {
        show: false,
        selectedOptions: {label: null, value: null},
        optionsBackup : null,
        options: optionsUsing,
        isSearching: false,
        search: null,
        defaultLabel,
        defaultMultipleLabel : optionsUsing,
        componentId,
        state,
        defaultValue,
        isMultiple,
        isSearchable,
        hasOptionUsing,
        msgContent,
        searchDebounce,
        async getOptionUsing() {
            this.options = await this.$wire.getOptionUsing(componentId)
            this.options.push(this.selectedOptions)
            this.$refs.list_options.innerHTML = OptionsBuilder(this.options)
        },
        async getResultsOnSearchTerm(term) {
            if (!this.hasOptionUsing) {
                this.options = await this.$wire.getSearchResultUsing(componentId, term)
            }
            if (this.hasOptionUsing){
                this.searchInOptions(term)
            }
            this.addSelectedOptionToNewList()
        },
        searchInOptions(term) {
            this.options = this.options.filter(option=> option.label.toLowerCase().match(new RegExp(term.toLowerCase())))
        },
        selectOptionFrom(item) {
            if (item) {
                this.selectedOptions = item
            }
        },
        addSelectedOptionToNewList(){
            if (!this.isMultiple && this.selectedOptions.value) {
                if (!Array.from(this.options).filter(option => (option.label === this.selectedOptions.label) && (option.value === this.selectedOptions.value)).length) {
                    this.options.push(this.selectedOptions)
                }
            }else {
                /** @Todo for select multiple */
            }
            this.$refs.list_options.innerHTML = OptionsBuilder(this.options)
        },
        search_terms: {
            async ['x-on:keyup.debounce.800ms']() {
                let term = this.$refs.search.value
                if (!this.isSearching && term !== '') {
                    if(!this.optionsBackup && this.hasOptionUsing ){
                        this.optionsBackup = this.options
                    }
                    this.isSearching = true
                    await this.getResultsOnSearchTerm(term)
                    this.isSearching = false
                }
                else if (this.hasOptionUsing){
                    this.options = this.optionsBackup
                    this.addSelectedOptionToNewList()
                }
            }
        },
        selectItem :{
            ['x-on:click.stop'](){
                if(!this.isMultiple){
                    this.selectOptionFrom({label: this.$el.dataset.label, value: this.$el.dataset.value})
                    this.defaultLabel = this.$el.dataset.label
                    this.state = this.$el.dataset.value
                    this.show = false
                }
                else {
                    this.defaultMultipleLabel.push({ label : this.$el.dataset.label})
                    this.defaultLabel = TagsBuilder(this.defaultMultipleLabel)
                    this.state.push(this.$el.dataset.value)

                    /**@todo Tags */
                }

                this.$refs.search.focus()
            }
        },
        resetOptions(){
            if (!this.isMultiple) {
                this.selectedOptions = {label: null, value: null}
                this.state = null
            }
            else {
                this.defaultMultipleLabel = []
                this.state = []
            }
            this.defaultLabel = null

            this.$refs.search.focus()
        },
        init() {

            if (this.isMultiple){
                this.defaultLabel = TagsBuilder(this.defaultMultipleLabel)
            }
            else {
                this.selectOptionFrom({label: defaultLabel, value: defaultValue})

                this.addSelectedOptionToNewList()
                if (!this.state){
                    this.state = []
                }
            }
           // console.log(this.state,this.options,defaultLabel,defaultValue)
            this.$watch('show',(value)=>{
                if(value) {
                    setTimeout(()=>{
                        this.$refs.search.focus()
                    },5)

                }
            })
        },
        showChoiceSelected(){
            if (!this.isMultiple){
                return this.selectedOptions.value
            }
            else {
               return this.defaultMultipleLabel.length > 0
            }
        }

    }
}
