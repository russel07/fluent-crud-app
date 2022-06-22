import Dashboard from './Components/Dashboard.vue';
import Authors from "./Modules/Author/Authors";
import Book from "./Modules/Book/Book";
import Books from "./Modules/Book/Books";
import Author from "./Modules/Author/Author";

export default [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            active: 'dashboard'
        }
    },
    {
        path: '/authors',
        name: 'authors',
        component: Authors,
        meta: {
            active: 'authors'
        }
    },
    {
        path: '/author/:id',
        name: 'author',
        component: Author,
        meta: {
            active: 'authors'
        }
    },
    {
        path: '/books',
        name: 'books',
        component: Books,
        meta: {
            active: 'books'
        }
    },
    {
        path: '/book/:id',
        name: 'book',
        component: Book,
        meta: {
            active: 'books'
        }
    }
];

