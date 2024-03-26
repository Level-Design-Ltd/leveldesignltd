import { registerBlockType } from "@wordpress/blocks";
import { RichText, useBlockProps } from "@wordpress/block-editor";

registerBlockType("leveldesignltd/button-block", {
    title: "Button Block",
    icon: "button",
    category: "design",
    attributes: {
        text: {
            type: "string",
            default: "Click me!",
        },
        variation: {
            type: "string",
            default: "default",
        },
    },
    edit: ({ attributes, setAttributes }) => {
        const { text, variation } = attributes;
        const blockProps = useBlockProps();
        const classes = `button-block-variation-${variation}`;

        const onChangeVariation = (newVariation) => {
            setAttributes({ variation: newVariation });
        };

        const onChangeText = (newText) => {
            setAttributes({ text: newText });
        };

        return (
            <div {...blockProps}>
                <div className="buttons">
                    <button
                        className={`variation-button ${
                            variation === "primary" ? "is-primary" : ""
                        }`}
                        onClick={() => onChangeVariation("primary")}
                    >
                        Primary
                    </button>
                    <button
                        className={`variation-button ${
                            variation === "secondary" ? "is-secondary" : ""
                        }`}
                        onClick={() => onChangeVariation("secondary")}
                    >
                        Secondary
                    </button>
                </div>
                <RichText
                    tagName="button"
                    value={text}
                    onChange={onChangeText}
                    placeholder="Add text..."
                    className={classes}
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        const { text, variation } = attributes;
        const blockProps = useBlockProps.save();
        const classes = `wp-block-button-block button-block-variation-${variation}`;

        return (
            <div {...blockProps}>
                <RichText.Content
                    tagName="button"
                    value={text}
                    className={classes}
                />
            </div>
        );
    },
});
