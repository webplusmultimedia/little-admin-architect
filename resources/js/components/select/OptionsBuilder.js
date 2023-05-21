/**
 *
 * @param {Object[]} options
 * @return {string}
 */
export function OptionsBuilder(options) {
    let results = ''
    options.forEach((option)=>{
        results += `<div class="choice__option" role="option" data-value="${option.value}"
            data-label="${option.label}"
            x-bind="selectItem"
        >
            ${option.label}
        </div>`
    })
     return results
}
