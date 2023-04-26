export default {
    // List routes the module supports
    routes: [
        {
            path: '/settings/site-owner',
            name: 'settings.site_owner',
            component: () => import('./views/SiteOwner.vue'),
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
