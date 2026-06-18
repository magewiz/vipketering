// Read/write nested values inside a plain object using a dotted key path.
// Used by the schema-driven page editor (e.g. "hero.heading").

export function getByPath(obj, path) {
    return path.split('.').reduce((acc, key) => (acc == null ? undefined : acc[key]), obj);
}

export function setByPath(obj, path, value) {
    const keys = path.split('.');
    let node = obj;
    for (let i = 0; i < keys.length - 1; i++) {
        const k = keys[i];
        if (node[k] == null || typeof node[k] !== 'object') node[k] = {};
        node = node[k];
    }
    node[keys[keys.length - 1]] = value;
}
