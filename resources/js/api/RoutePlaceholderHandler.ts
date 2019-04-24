import PlaceholderHandler from "../helpers/PlaceholderHandler";

export default class RoutePlaceholderHandler extends PlaceholderHandler {

    protected interpolate(template: string, placeholder: string, value: string): string {
        let placeholderPattern: RegExp =  this.placeholderGenerator.create(placeholder);
        if(RoutePlaceholderHandler.has(template, placeholderPattern)) {
            return template.replace(
                placeholder,
                value
            )
        }
        return RoutePlaceholderHandler.addQueryParam(
            template,
            placeholder,
            value
        )
    }

    protected static has(template: string, placeholder: RegExp): boolean {
        return placeholder.test(template);
    }

    protected static addQueryParam(template: string, placeholder: string, value: string): string {
        let separator = template.indexOf("?") > 0 ? "&" : "?";
        let valuesArray = value.split("|");
        if(valuesArray.length > 1) {
            placeholder = `${placeholder}[]`;
        }

        let query: string[] = [];
        valuesArray.forEach(
            function (value: string) {
                value = encodeURIComponent(value);
                query.push(`${placeholder}=${value}`);
            }
        );
        let queryString = query.join("&");

        return `${template}${separator}${queryString}`
    }

}