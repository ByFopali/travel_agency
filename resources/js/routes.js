import App from './components/App'
import Home from './components/Home'
import About from './components/About'
import Tours from './components/Tours/Tours'
import CreateTour from "./components/Tours/CreateTour";
import ShowTour from "./components/Tours/ShowTour";
import DeleteTour from "./components/Tours/DeleteTour";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/about',
        name: 'about',
        component: About
    },
    {
        path: '/tours',
        name: 'tours',
        component: Tours
    },
    {
        path: '/tours/create',
        name: 'toursCreate',
        component: CreateTour
    },
    {
        path: '/tours/:tourId',
        name: 'tourShow',
        component: ShowTour,
        props: true,
    },
    {
        path: '/api/tours/${tourId}',
        name: 'tourDelete',
        component: DeleteTour,
        props: true,
    }
];

export default routes;
