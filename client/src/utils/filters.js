import moment from "moment"

export function truncate(target, len, clamp = '...') {
    return target.length > len ? target.slice(0, len) + clamp : target;
}

export function datetime(target, format = 'MMMM Do YYYY, h:mm:ss a') {
    return moment(target).format(format)
}

export function eachProp(target, handle) {
    const result = {};
    for (let prop in target) {
        result[prop] = handle(target[prop]);
    }
    return result;
}

export default {}