import Vue from "vue";
export const EventBus = new Vue();

export class Errors
{
    constructor(){
        this.errors = {}
    }
    any(){
        return Object.keys(this.errors).length > 0;
    }
    has(field){
        // if this.errors contains a "field" property
        return this.errors.hasOwnProperty(field);
    }
    get(field){
        if (!this.errors[field]) {
            return;
        }
        return this.errors[field][0];
    }
    record(errors){
        this.errors = errors;
    }
    clear(field){
        if (!this.errors[field]) {
            return;
        }
        delete this.errors[field];
    }
    clearAll(){
        this.errors = {}
    }
}
