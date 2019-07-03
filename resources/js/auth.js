export function getLocalUser() {
    const userStr = localStorage.getItem('user');

    return JSON.parse(userStr);
}

export function getLocalToken() {
    const tokenStr = localStorage.getItem('token');

    return JSON.parse(tokenStr);
}