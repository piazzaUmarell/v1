export default class Keyword {

    protected keyword: string;
    protected composed: boolean;

    constructor(keyword: string) {
        this.keyword = keyword;
        this.composed = keyword.indexOf(" ") > 0;
    }

    public toString(): string {
        return this.keyword;
    }
}