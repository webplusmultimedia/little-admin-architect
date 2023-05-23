/**
 *
 * @param {Object[]} options
 * @return {string}
 */
export function OptionsBuilder(options) {
    let results = ''
    options.forEach((option) => {
        results += `<div class="choice__option" role="option"
            data-value="${option.value}"
            data-label="${option.label}"
            x-bind="selectItem"
        >
            ${option.label}
        </div>`
    })
    return results
}

export function TagsBuilder(optionsTags) {
    let results = ''
    optionsTags.forEach((option) => {
        results += `<div class="choice__tag"
            data-value="${option.value}"
            data-label="${option.label}"
            x-data="{}"
            x-ref="tagElement"
        >
            <span class="choice__tag_label">${option.label}</span>
            <svg class="choice_tag_icon" fill="currentColor"  viewBox="0 0 24 24" x-bind="deleteTag">
                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>
        </div>`;
    })
    return results
}
