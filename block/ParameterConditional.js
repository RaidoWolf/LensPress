//import {InnerBlocks} from '@wordpress/editor';
//import {TextControl} from '@wordpress/components';

(function () {
    'use strict';

    const {registerBlockType} = wp.blocks;
    const blockStyle = {
        backgroundColor: '#2260AA',
        color: '#ffffff',
        padding: '20px'
    };

    registerBlockType('lenspress/param-condition', {

        title: __('Parameter Condition'),
        icon: 'randomize',
        category: 'layout',

        keywords: [
            __('if'),
            __('else'),
            __('condition'),
            __('conditional'),
            __('parameter'),
            __('url'),
            __('get'),
            __('post'),
            __('cookie'),
            __('switch'),
            __('replace'),
            __('content')
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
                            onChange={(paramName) => { setAttributes({paramName}); }}
                        />
                    </PanelBody>
                </InspectorControls>,
                <div className={props.className}>
                    {__('Switch between two versions of a content block depending on a parameter.')}
                    <InnerBlocks />
                </div>
            ];

        },

        save: function (props) {

            return (
                <InnerBlocks.Content />
            );

        }

    });

})();
