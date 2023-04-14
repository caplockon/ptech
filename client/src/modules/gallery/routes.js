export default {
    // List routes the module supports
    routes: [
        {
            path: '/gallery',
            name: 'gallery.index',
            component: () => import('./views/IndexView.vue'),
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
