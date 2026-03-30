const $ = window.YMarketJQuery || window.jQuery;
const BX = window.BX;

export class Category {

    static defaults = {
        url: null,
        parameters: {},
        language: 'ru',
        lang: null,
	    copyElement: '[data-entity="copy"]',
    }

	_bindSearchPaste = false;
    _lastError;

    constructor(element: HTMLElement, options: Object = {}) {
        this.$el = $(element);
        this.el = element;
        this.options = Object.assign({}, this.constructor.defaults, options);

	    this.bind();
        this.bootSelect();
    }

	bind() {
		this.handleSelectOpen();
		this.handleSelectClose();
		this.handleCopy();
	}

	handleCopy() : void {
		const button = this.$el.nextAll(this.options.copyElement);

		button.on('click', this.onCopyClick);
	}

	handleSelectOpen() : void {
		this.$el.on('select2:open', this.onSelectOpen);
	}

	handleSelectClose() : void {
		this.$el.on('select2:closing', this.onSelectClosing);
	}

	handleSearchPaste(dir: boolean) : void {
		if (this._bindSearchPaste === dir) { return; }

		const search = $('.select2-search__field');

		search[dir ? 'on' : 'off']('paste', this.onSearchPaste);
		this._bindSearchPaste = dir;
	}

	onCopyClick = () : void => {
		const value = this.$el.val();

		this.copyClipboard(value);
	}

	onSelectOpen = () : void => {
		this.handleSearchPaste(true);
	}

	onSelectClosing = () : void => {
		this.handleSearchPaste(false);
	}

	onSearchPaste = (e) : void => {
		const paste = (e.originalEvent.clipboardData || window.clipboardData).getData('text/plain').toString();
		const lines = paste.split(/(\n\r|\n|\r)/gm).map((line) => line.trim()).filter((line) => line !== '');

		if (paste.indexOf(' / ') !== -1 || lines.length < 2) { return; }

		e.target.value = lines.join(' / ');
		e.preventDefault();

		$(e.target).trigger('input');
	}

    bootSelect() : void {
        this.$el.select2(Object.assign({}, {
            minimumInputLength: 2,
            selectOnClose: true,
	        allowClear: true,
            ajax: {
                cache: true,
                delay: 250,
                transport: this.ajaxTransport,
            },
            templateSelection: this.templateSelection,
        }, this.getLanguageOptions()));
    }

    getLanguageOptions() : Object {
        return {
            placeholder: this.getLang('PLACEHOLDER'),
            language: this.options.lang == null ? this.options.language : Object.assign(this.languageDefaults(), {
                errorLoading: () => {
                    if (this._lastError != null) {
                        const error = this._lastError;
                        this._lastError = null;

                        return error;
                    }

                    return this.getLang('LOAD_ERROR');
                },
            }),
        }
    }

    languageDefaults() : Object {
        try {
            return $.fn.select2.amd.require(`select2/i18n/${this.options.language}`)
        } catch (e) {
            console.error(e);
            return {};
        }
    }

    ajaxTransport = (params: Object, success: () => {}, failure: () => {}) : void => {
	    if (/.+\/.+\[\d+]/.test(params.data.q)) {
		    success(this.prepareData([params.data.q]));
		    return;
	    }

        BX.ajax({
            url: this.options.url,
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'search',
                query: params.data.q,
                parameters: this.options.parameters,
	            language: this.options.language,
            },
            onsuccess: (data) => {
                if (data.status === 'ok') {
                    const preparedData = this.prepareData(data.data);
                    success(preparedData);
                } else if (data.status === 'error') {
                    this._lastError = data.message;
                    failure();
                } else {
                    this._lastError = 'unknown response format';
                    failure();
                }
            },
            onfailure: (data) => {
                this._lastError = data.message;
                failure();
            }
        });

        return {};
    }

    templateSelection = (variant: Object) : string => {
        return variant.id === '' ? variant.text : variant.id;
    }

    prepareData(options: Array) : Object {
        const data = [];

        for (const option of options) {
            data.push({
                id: option,
                text: option,
            });
        }

        return {
            results: data,
        };
    }

    getLang(key, replaces) {
        const template = this.options.lang[key] || '';

        return this.compileTemplate(template, replaces);
    }

    compileTemplate(template, replaces) {
        let result = template;

        for (const key in replaces) {
            if (!replaces.hasOwnProperty(key)) { continue; }

            const replaceKey = '#' + key + '#';
            const replaceValue = replaces[key];

            do {
                result = result.replace(replaceKey, replaceValue);
            } while (result.indexOf(replaceKey) !== -1);
        }

        return result;
    }

	copyClipboard(text: string) : void {
		const fake = $('<textarea></textarea>').css({
			position: 'absolute',
			left: '-9999px',
			top: '-9999px',
		});

		fake.insertAfter(this.$el);
		fake.val(text);
		fake[0].select();

		this.execCommand('copy');

		fake.remove();
	}

	execCommand(command: string) : bool {
		try {
			document.execCommand(command);
			return true;
		} catch (err) {
			console.log(err);
			return false;
		}
	}
}