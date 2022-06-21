import Dashboard from './Components/Dashboard.vue';
import Authors from "./Modules/Author/Authors";

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
        path: '/author',
        name: 'author',
        component: Authors,
        meta: {
            active: 'author'
        }
    }
];

