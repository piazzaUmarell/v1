import PlaceholderPatternGenerator from "./PlaceholderPatternGenerator";

export default class PlaceholderHandler {

    protected placeholderGenerator: PlaceholderPatternGenerator;

    public constructor(patternGenerator: PlaceholderPatternGenerator) {
        this.placeholderGenerator = patternGenerator;
    }

    public handle(template: string, placeholders: {}): string {
        for(let placeholder in placeholders) {
            if(!placeholders.hasOwnProperty(placeholder)) continue;
            let placeholderValue = PlaceholderHandler.parseValue(placeholders[placeholder]);
            template = this.interpolate(
                template,
                placeholder,
                placeholderValue
            );
        }
        return template;
    }

    protected static parseValue(value: any) : string {
        if(typeof value === "string" || typeof value === "number") {
            return value + "";
        }

        if(Array.isArray(value)) {
            return value.join("|");
        }

        if(typeof value === "object" && typeof value.toString === "function") {
            return value.toString();
        }

        throw Error("Impossible to parse the value passed")
    }

    protected interpolate(template: string, placeholder: string, value: string): string {
        console.log(this.placeholderGenerator.create(placeholder));
        return template.replace(
            this.placeholderGenerator.create(placeholder),
            value
        );
    }

}