export class User {
    name: string;
    username = 'demo-admin@example.invalid';
    password = '123456';

    constructor(name:string) {
        this.name = name;
    }
}