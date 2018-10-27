(function () {
    'use strict';

    const {__} = wp.i18n;
    const {InnerBlocks, InspectorControls} = wp.editor;
    const {PanelBody, CheckboxControl, TextControl} = wp.components;
    const {registerBlockType} = wp.blocks;

    const blockStyle = {
        backgroundColor: '#2260AA',
        color: '#ffffff',
        'text-align': 'center',
        padding: '20px',
        'border-radius': '8px'
    };
    const contentStyle = {
        backgroundColor: '#ffffff',
        color: '#000000',
        'text-align': 'left',
        padding: '5px',
        'border-radius' : '8px',
        'box-shadow': '3px 3px 8px rgba(0,0,0,0.5)'
    }

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
                type: 'string',
                default: 'hidden'
            },

            match: {
                type: 'string',
                default: 'show'
            },

            negate: {
                type: 'boolean',
                default: false
            },

            enableUrl: {
                type: 'boolean',
                default: true
            },

            enablePost: {
                type: 'boolean',
                default: true
            },

            enableCookie: {
                type: 'boolean',
                default: true
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
                        <TextControl
                            label={__('Match Value')}
                            value={attributes.match}
                            onChange={(match) => { setAttributes({match}); }}
                        />
                        <CheckboxControl
                            label={__('Negate the Check')}
                            help={__('Check for when the condition is FALSE')}
                            checked={attributes.negate}
                            onChange={(negate) => { setAttributes({negate}); }}
                        />
                        <CheckboxControl
                            label={__('Enable GET Parameters')}
                            help={__('Enable checking for the parameter in the URL itself')}
                            checked={attributes.enableUrl}
                            onChange={(enableUrl) => { setAttributes({enableUrl}); }}
                        />
                        <CheckboxControl
                            label={__('Enable POST Parameters')}
                            help={__('Enable checking for the parameter in the data sent via a POST request')}
                            checked={attributes.enablePost}
                            onChange={(enablePost) => { setAttributes({enablePost}); }}
                        />
                        <CheckboxControl
                            label={__('Enable COOKIE Parameters')}
                            help={__('Enable checking for the parameter in the browser\'s cookies')}
                            checked={attributes.enableCookie}
                            onChange={(enableCookie) => { setAttributes({enableCookie}); }}
                        />
                    </PanelBody>
                </InspectorControls>,
                <div className={props.className} style={blockStyle}>
                    {__('Parameter Case')}
                    <div style={contentStyle}>
                        <InnerBlocks />
                    </div>
                </div>
            ];

        },

        save: function (props) {

            return <InnerBlocks.Content />

        }

    });

})();
