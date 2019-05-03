export default class ErrorBag {

    constructor(errors = null) {
        this.set(errors ? errors : {});
    }

    set(errors){
        this.errors = errors;
    }

    has(fieldName) {
        return  this.errors.hasOwnProperty(fieldName) && this.errors[fieldName];
    }

    any() {
        for(let field in this.errors) {
            if(!this.errors.hasOwnProperty(field)) continue;
            if(this.has(field)) return true;
        }
        return false;
    }

    clear(fieldName = null) {
        if(this.errors.hasOwnProperty(fieldName)) {
            this.errors[fieldName] = null;
        } else {
            delete this.errors[fieldName];
        }
    }

    get(fieldName) {
        if(!this.has(fieldName)) {
            return null;
        }
        let errors = this.errors[fieldName];
        if(Array.isArray(errors)) {
            return errors[0];
        }
        return errors;
    }

    all(fieldName = null) {
        if(fieldName == null) {
            let errorsCollection = [];
            for(let field in this.errors) {
                if(!this.errors.hasOwnProperty(field)) continue;

                errorsCollection = errorsCollection.concat(
                    this._serializeError(field)
                );
            }
            return errorsCollection;
        }

        if(!this.has(fieldName)) {
            return [];
        }

        return this._serializeError(fieldName);
    }

    _serializeError(fieldName) {

        if(!this.errors.hasOwnProperty(fieldName)) {
            return [];
        }

        let fieldErrors = this.errors[fieldName];

        if(!Array.isArray(fieldErrors)) {
            fieldErrors = [fieldErrors];
        }

        return fieldErrors;
    }

}