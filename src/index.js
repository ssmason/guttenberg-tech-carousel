import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import '../block/editor.css';

registerBlockType('custom/tech-icons-carousel', {
    edit: () => {
        return (
            <div {...useBlockProps()}>Tech Icons Carousel (Preview not available)</div>
        );
    },
    save: null
});
