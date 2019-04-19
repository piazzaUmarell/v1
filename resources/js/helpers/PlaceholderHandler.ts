import PlaceholderPatternGenerator from "./PlaceholderPatternGenerator";

export default class PlaceholderHandler {

    protected placeholderGenerator: PlaceholderPatternGenerator;

    public constructor(patternGenerator: PlaceholderPatternGenerator) {
        // this.placeholderPattern = new RegExp(pattern);
        this.placeholderGenerator = patternGenerator;
    }

    public handle(template: string, placeholders: {}): string {
        for(let placeholder in placeholders) {
            console.log("SEARCHING FOR PLACEHOLDER " + placeholder + " in template " + template);
            if(!placeholders.hasOwnProperty(placeholder)) continue;
            template = this.interpolate(
                template,
                placeholder,
                placeholders[placeholder]
            );
        }
        return template;
    }

    private interpolate(template: string, placeholder: string, value: string): string {
        return template.replace(
            this.placeholderGenerator.create(placeholder),
            value
        );
    }

}