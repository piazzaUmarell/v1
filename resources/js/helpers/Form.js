import ErrorBag from './ErrorBag';
import axios from 'axios';

export default class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this._originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new ErrorBag();
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this._originalData) {
            if(!this._originalData.hasOwnProperty(property)) continue;
            data[property] = this[property];
        }

        return data;
    }


    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this._originalData) {
            if(!this._originalData.hasOwnProperty(field)) continue;
            if(!this.hasOwnProperty(field)) continue;
            this[field] = '';
        }

        this.errors.clear();
    }


    /**
     * Send a GET request to the given URL.
     * .
     * @param {string} url
     */
    get(url) {
        return this.submit('GET', url);
    }

    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url) {
        return this.submit('POST', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('PUT', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('PATCH', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('DELETE', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType.toLowerCase()](
                url,
                this.data(),
                {
                    headers: {
                        'Content-Type': "application/json"
                    }
                }
            )
                .then(response => {
                    this.onSuccess(response.data);
                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);
                    reject(error.response.data);
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        this.reset();
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.set(errors);
    }
}