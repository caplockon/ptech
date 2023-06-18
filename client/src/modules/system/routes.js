export default {
    // List routes the module supports
    routes: [
        {
            path: '/system/owner',
            name: 'system.owner',
            component: () => import('./views/OwnerView.vue'),
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
