import GlobalAccessor from "./GlobalAccessor";

export default abstract class BoundGlobalAccessor {

    protected globalAccessor: GlobalAccessor;

    abstract getBoundProperty(): string;

    protected constructor() {
        this.globalAccessor = new GlobalAccessor(
            this.getBoundProperty()
        );
    }

    public get(label: string) {
        return this.globalAccessor.get(label);
    }

}