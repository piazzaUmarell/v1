import Keyword from "./Keyword";

export default class KeywordCollection {

    protected collection: Keyword[] = [];
    protected separators: string[] = [" "];
    protected aggregators: string[] = ["\""];
    protected lengthLimit: number = 3;

    public constructor(source: string, lengthLimit: number = 3, separators: string[] = [], aggregators: string[] = []) {
        this.separators = separators.length > 0 ? separators : this.separators;
        this.aggregators = aggregators.length > 0 ? aggregators : this.aggregators;
        this.lengthLimit = lengthLimit;

        let buffer: string = "";
        let aggregate: boolean = false;
        for(let i = 0; i < source.length; i++) {
            let isASeparator: boolean = this.separators.indexOf(source[i]) >= 0;
            let isAnAggregator: boolean = this.aggregators.indexOf(source[i]) >= 0;

            if(isAnAggregator) {
                aggregate = !aggregate;
                this.addFromString(buffer);
                buffer="";
                continue;
            }

            if(isASeparator && !aggregate) {
                this.addFromString(buffer);
                buffer = "";
                continue;
            }

            buffer+=source[i];
        }

        if(buffer) {
            this.addFromString(buffer);
        }
    }

    public toString() {
        return this.collection.join("|");
    }

    public add(keyword: Keyword): KeywordCollection {
        this.collection.push(keyword);
        return this;
    }

    public addFromString(keyword: string): KeywordCollection {
        if(keyword.length < this.lengthLimit) return;
        return this.add(new Keyword(keyword));
    }

}