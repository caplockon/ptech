export default {
    // List routes the module supports
    routes: [
        {
            path: '/kanban/projects',
            name: 'kanban.index',
            component: () => import('./views/ProjectListView.vue'),
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
