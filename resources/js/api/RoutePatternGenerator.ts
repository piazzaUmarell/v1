import PlaceholderPatternGenerator from "../helpers/PlaceholderPatternGenerator";

export default class RoutePatternGenerator extends PlaceholderPatternGenerator {
    public create(placeholder: string): RegExp {
        return new RegExp(`{ *${placeholder} *}`)
    }
}