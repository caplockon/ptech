export default {
    // List routes the module supports
    routes: [
        {
            path: '/kanban/projects',
            name: 'kanban.index',
            component: () => import('./views/ProjectListView.vue'),
            meta: {requiresAuth: true}
        },
        {
            path: '/kanban/project/pro-1',
            name: 'kanban.project.board',
            component: () => import('./views/ProjectKanboardView.vue'),
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
