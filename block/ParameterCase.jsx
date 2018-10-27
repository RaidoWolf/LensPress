(function () {
    'use strict';

    const {__} = wp.i18n;
    const {InnerBlocks, InspectorControls} = wp.editor;
    const {PanelBody, CheckboxControl, TextControl} = wp.components;
    const {registerBlockType} = wp.blocks;
    const blockStyle = {
        backgroundColor: '#2260AA',
        color: '#ffffff',
        padding: '20px'
    };

    registerBlockType('lenspress/param-case', {

        title: __('Parameter Case'),
        icon: 'randomize',
        category: 'layout',

        keywords: [
            __('lenspress'),
            __('parameter'),
            __('case')
        ],

        attributes: {

            paramName: {
                type: 'string'
            },

            enableUrl: {
                type: 'boolean'
            },

            enablePost: {
                type: 'boolean'
            },

            enableCookie: {
                type: 'boolean'
            }

        },

        edit: function (props) {

            const {attributes, setAttributes} = props;

            return [
                <InspectorControls>
                    <PanelBody title={__('Content Settings')}>
                        <TextControl
                            label={__('Parameter Name')}
                            value={attributes.paramName}
                            onChange={(paramName) => { setAttributes({paramName}); }}
                        />
                        <CheckboxControl
                            label={__('Enable GET Parameters')}
                            help={__('Enable checking for the parameter in the URL itself')}
                            checked={attributes.urlEnabled}
                            onChange={(urlEnabled) => { setAttributes({urlEnabled}); }}
                        />
                        <CheckboxControl
                            label={__('Enable POST Parameters')}
                            help={__('Enable checking for the parameter in the data sent via a POST request')}
                            checked={attributes.postEnabled}
                            onChange={(postEnabled) => { setAttributes({postEnabled}); }}
                        />
                        <CheckboxControl
                            label={__('Enable COOKIE Parameters')}
                            help={__('Enable checking for the parameter in the browser\'s cookies')}
                            checked={attributes.cookieEnabled}
                            onChange={(cookieEnabled) => { setAttributes({cookieEnabled}); }}
                        />
                    </PanelBody>
                </InspectorControls>,
                <div className={props.className}>
                    {__('Switch between any number of versions of a content block depending on a parameter.')}
                    <InnerBlocks />
                </div>
            ];

        },

        save: function (props) {

            const {attributes, setAttributes} = props;

            return [
                '[lenspress-param-case',
                    'param="'+(attributes.paramName).replace('"', '\"')+'"',
                    'match="'+(attributes.match).replace('"', '\"')+'"',
                    'negate="'+(attributes.negate ? '1' : '0')+'" ',
                    'url="'+(attributes.urlEnabled ? '1' : '0')+'"',
                    'post="'+(attributes.postEnabled ? '1' : '0')+'"',
                    'cookie="'+(attributes.cookieEnabled ? '1' : '0')+'"]',
                <InnerBlocks.Content />,
                '[/lenspress-param-case]'
            ];

        }

    });

})();
