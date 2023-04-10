export default {
    // List routes the module supports
    routes: [
        {
            path: '/flights',
            name: 'flight.index',
            component: () => import('./views/IndexView.vue'),
            meta: {requiresAuth: true}
        },
        {
            path: '/flights/:uuid',
            name: 'flight.edit',
            component: () => import('./views/EditView.vue'),
            meta: {requiresAuth: true}
        },
        {
            path: '/flights/create',
            name: 'flight.create',
            component: () => import('./views/CreateView.vue'),
            meta: {requiresAuth: true}
        }
    ],

    // Before each route
    beforeEach: [
        () => {}
    ],

    // After each route
    afterEach: [
        () => {}
    ]
};
