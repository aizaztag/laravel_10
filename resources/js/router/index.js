import {createRouter, createWebHistory } from "vue-router";
import User from "../components/user/Index.vue";
import Post from "../components/Posts/Index.vue";
import AllProduct from '../components/products/AllProduct.vue';
import CreateProduct from '../components/products/CreateProduct.vue';
import EditProduct from '../components/products/EditProduct.vue';
//import About from "../../views/about/Index.vue";

const routes = [
    {
        path: "/",
        name: "posts",
        component: Post,
    },
    {
        path: "/users",
        name: "users",
        component: User,
    },
    {
        path: '/products',
        children: [
            {
                name: 'allProducts',
                path: '/products',
                component: AllProduct
            },
            {
                name: 'createProduct',
                path: '/products/create',
                component: CreateProduct
            },
            {
                name: 'editProduct',
                path: '/products/edit/:id',
                component: EditProduct
            }
        ]
    }

];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
