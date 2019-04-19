export default class GlobalAccessor {

    protected globalKey: string;

    public constructor(property: string){
        this.globalKey = property;
    }

    get (key: string): any {
        if(!window.hasOwnProperty(this.globalKey)) {
            console.error(`"${this.globalKey}" not found`);
            return null;
        }

        let path = key.split(".");
        let iterator = window[this.globalKey];
        for(let i = 0; i < path.length; i++) {
            let searchPath = GlobalAccessor.getPartialPath(path, i);
            if(!iterator.hasOwnProperty(path[i])) {
                console.error(`${searchPath} was not found`);
                return null;
            }
            iterator = iterator[path[i]];
        }

        return iterator;
    }

    protected static getPartialPath(pathComponents: string[], lastElement: number) {
        lastElement = Math.min(lastElement + 1, pathComponents.length);
        return pathComponents.slice(0, lastElement).join(".");
    }

}