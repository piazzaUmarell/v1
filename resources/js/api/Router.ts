import BoundGlobalAccessor from "../helpers/BoundGlobalAccessor";
import PlaceholderHandler from "../helpers/PlaceholderHandler";
import RoutePatternGenerator from "./RoutePatternGenerator";
import RoutePlaceholderHandler from "./RoutePlaceholderHandler";

export default class Router extends BoundGlobalAccessor {

    protected placeholderHandler: PlaceholderHandler;

    public constructor() {
        super();
        this.placeholderHandler = new RoutePlaceholderHandler(
            new RoutePatternGenerator()
        )
    }

    public getBoundProperty(): string {
        return "ROUTES";
    }

    public route(name: string, parameters: {} = {}): string {
        return this.placeholderHandler.handle(
            this.globalAccessor.get(name),
            parameters
        );
    }

}