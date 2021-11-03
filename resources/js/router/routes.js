const routes = [
    {
        path: "/login",
        name: "Login",
        component: () => import("../pages/public/Login"),
    },
    {
        path: "/",
        name: "Main",
        component: () => import("../pages/main/Index"),
        meta: {
            auth: true,
        },
        children: [
            {
                name: "Dashboard",
                path: "dashboard",
                component: () => import("../components/Dashboard/Index"),
            },
            {
                name: "Role",
                path: "role",
                component: () => import("../components/Role/Index"),
            },
            {
                name: "User",
                path: "user",
                component: () => import("../components/User/Index"),
            },
            {
                name: "Expense Category",
                path: "expense-category",
                component: () => import("../components/ExpenseCategory/Index"),
            },
            {
                name: "Expense",
                path: "expense",
                component: () => import("../components/Expense/Index"),
            },
        ],
    },
    {
        path: "/*",
        component: () => import("../pages/main/Index"),
    },
];

export default routes;
