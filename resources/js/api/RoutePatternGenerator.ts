import PlaceholderPatternGenerator from "../helpers/PlaceholderPatternGenerator";

export default class RoutePatternGenerator extends PlaceholderPatternGenerator {
    public create(placeholder: string) {
        return new RegExp(`{ *${placeholder} *}`)
    }
}